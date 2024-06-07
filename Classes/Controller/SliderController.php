<?php
namespace NITSAN\NsRevolutionSlider\Controller;

use TYPO3\CMS\Core\Utility\VersionNumberUtility;

/***
 *
 * This file is part of the "[NITSAN] Revolution slider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019
 *
 ***/

 use NITSAN\NsRevolutionSlider\Domain\Model\SlideItem;
 use NITSAN\NsRevolutionSlider\Domain\Model\Slider;
 use NITSAN\NsRevolutionSlider\Domain\Repository\SlideItemRepository;
 use NITSAN\NsRevolutionSlider\Domain\Repository\SliderRepository;
 use Psr\Http\Message\ResponseInterface;
 use TYPO3\CMS\Core\Core\Environment;
 use TYPO3\CMS\Core\Page\PageRenderer;
 use TYPO3\CMS\Core\Resource\Exception\InvalidFileException;
 use TYPO3\CMS\Core\Utility\GeneralUtility;
 use TYPO3\CMS\Core\Utility\PathUtility;
 use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * SliderController
 */
class SliderController extends ActionController
{

    /**
     * @var ?SliderRepository
     */
    protected ?SliderRepository $sliderRepository = null;

    /**
     * @var ?SlideItemRepository
     */
    protected ?SlideItemRepository $slideItemRepository = null;

    /**
     * @var PageRenderer
     */
    protected PageRenderer $pageRenderer;

    /**
     * @param sliderRepository $sliderRepository
     */
    public function injectSliderRepository(SliderRepository $sliderRepository)
    {
        $this->sliderRepository = $sliderRepository;
    }

    /**
     * @param slideItemRepository $slideItemRepository
     */
    public function injectSlideItemRepository(SlideItemRepository $slideItemRepository)
    {
        $this->slideItemRepository = $slideItemRepository;
    }

    /**
     * Init
     */
    public function initializeAction()
    {
        //Fetch current record information
        $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        //Plug-in settings
        $settings = $this->settings;
        //Javascript and CSS files fetch from folder
        $typo3VersionArray = VersionNumberUtility::convertVersionStringToArray(
            VersionNumberUtility::getCurrentTypo3Version()
        );
        if (version_compare($typo3VersionArray['version_main'], '9.0', '>')) {
            $javascript = GeneralUtility::getFilesInDir(Environment::getPublicPath() . '/' . $settings['jsFolderPath']);
            $css = GeneralUtility::getFilesInDir(Environment::getPublicPath() . '/' . $settings['cssFolderPath']);
        } else {
            // @extensionScannerIgnoreLine
            $javascript = GeneralUtility::getFilesInDir(PATH_site . $settings['jsFolderPath']);
            $css = GeneralUtility::getFilesInDir(PATH_site . $settings['cssFolderPath']);
        }
        if ($settings['includeJquery']) {
            $this->pageRenderer->addJsFooterFile($settings['jQueryFile']);
        }

        $this->addAssets($javascript, 'js', $settings['jsFolderPath']);
        $this->addAssets($css, 'css', $settings['cssFolderPath']);

        if ($settings['customStyleFilePath']) {
            $this->pageRenderer->addCssFile($settings['customStyleFilePath']);
        }
        parent::initializeAction();
    }

    /**
     * action slider
     */
    public function sliderAction()
    {
        $this->contentObj = $this->configurationManager->getContentObject();
        $uid = $this->contentObj->data['uid'];
        //Plug-in settings
        $settings = $this->handleSettings($this->settings);
        $customSettings = $this->customSettings($settings);

        //Slider logic
        $slides = [];
        if ($settings['slides_type']) {
            if ($settings['slides'] != '') {
                $slidesUids = explode(',', $settings['slides']);
                foreach ($slidesUids as $slide) {
                    $slideData = $this->slideItemRepository->findByUid($slide);
                    if ($slideData instanceof SlideItem) {
                        $slides[] = $this->handleSlideData($slideData, $settings);
                    }
                }
            }
        } else {
            if ($settings['slider']) {
                $slideData = $this->sliderRepository->findByUid($settings['slider']);
                if ($slideData instanceof Slider) {
                    foreach ($slideData->getSlides() as $slide) {
                        $slides[] = $this->handleSlideData($slide, $settings);
                    }
                }
            }
        }

        $this->view->assignMultiple(
            [
                'feSettings' => $customSettings,
                'uid' => $uid,
                'slides' => $slides,
            ]
        );

        $settings['customStyle'] = $settings['customStyle'] ?? '';
        if ($settings['customStyle']) {
            $GLOBALS['TSFE']->additionalHeaderData[
                $this->request->getControllerExtensionKey() . '_' . $uid . '_style'] .=
                "<style type='text/css'>"
                    . $settings['customStyle'] .
                '</style>'
            ;
        }
        $data = $this->prepareJsonObject($settings);
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] =
            isset($GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid]) ?
                $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] : '';
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] .= "
            <script type='text/javascript'>
                jQuery('#rev_slider_" . $uid . "').show().revolution($data);
            </script>
        ";
    }

    /**
     * @param array $settings
     */
    protected function prepareJsonObject(array $settings)
    {
        $dataArray = [
            'sliderLayout' => $settings['sliderLayout'],
            'sliderType' => 'standard',
            'shadow' => isset($settings['shadow']) && $settings['shadow'] !== '' ? 'spinner1' : 'spinner0',
            'spinner' => $settings['spinner'] ? 'spinner3' : 'off',
            'stopLoop' => $settings['stopLoop'] ? 'on' : 'off',
            'stopAfterLoops' => $settings['stopLoop'] ? 0 : -1,
            'stopAtSlide' => (isset($settings['stopAtSlide']) &&
                $settings['stopAtSlide'] !== '' &&
                $settings['stopAtSlide'] !== '-1' &&
                $settings['stopAtSlide'] !== '0' &&
                $settings['stopLoop']) ? $settings['stopAtSlide'] : -1,
            'delay' => 2000,
            'responsiveLevels' => isset($settings['responsiveLevels']) && $settings['responsiveLevels'] !== '' ?
                explode(',', $settings['responsiveLevels']) : [],
            'visibilityLevels' => isset($settings['visibilityLevels']) && $settings['visibilityLevels'] !== '' ?
                explode(',', $settings['visibilityLevels']) : [],
            'gridwidth' => isset($settings['gridwidth']) && $settings['gridwidth'] !== '' ?
                explode(',', $settings['gridwidth']) : [],
            'gridheight' => isset($settings['gridheight']) && $settings['gridheight'] !== '' ?
                explode(',', $settings['gridheight']) : [],
            'hideSliderAtLimit' => isset($settings['hideSliderAtLimit']) && $settings['hideSliderAtLimit'] !== '' ?
                $settings['hideSliderAtLimit'] : 0,
            'debugMode' => (bool)$settings['debugMode'],
            'navigation' => [
                'keyboardNavigation' => $settings['keyboardNavigation'] ? 'on' : 'off',
                'keyboard_direction' => $settings['keyboard_direction'],
                'mouseScrollNavigation' => $settings['mouseScrollNavigation'] ? 'on' : 'off',
                'onHoverStop' => $settings['onHoverStop'] ? 'on' : 'off',
                'touch' => [
                    'touchenabled' => $settings['touchenabled'] ? 'on' : 'off',
                    'swipe_threshold' => 75,
                    'swipe_min_touches' => 1,
                    'swipe_direction' => 'horizontal',
                    'drag_block_vertical' => true,
                ],
                'arrows' => [
                    'enable' => $settings['bulletsEnable'] ? 'true' : 'false',
                    'hide_onleave' => false,
                    'style' => $settings['arrowsStyle'],
                ],
                'bullets' => [
                    'enable' => $settings['bulletsEnable'] ? 'true' : 'false',
                    'hide_onleave' => false,
                    'style' => $settings['bulletsStyle'],
                    'h_align' => 'center',
                    'v_align' => 'bottom',
                    'h_offset' => 0,
                    'v_offset' => 0,
                    'space' => 0,
                ],
            ],
        ];

        return json_encode($dataArray, JSON_PRETTY_PRINT);
    }

    /**
     * @param SlideItem $slideData
     * @param array $settings
     * @return SlideItem
     */
    protected function handleSlideData(SlideItem $slideData, array $settings): SlideItem
    {
        $slideData->setSlideEffect(
            $slideData->getSlideEffect() === '' ?
                $settings['slideEffect'] : $slideData->getSlideEffect()
        );
        $slideData->setHeadlineAnimation(
            $slideData->getHeadlineAnimation() === '' ?
                $settings['headlineAnimation'] : $slideData->getHeadlineAnimation()
        );
        $slideData->setHeadlineSize($settings['headlineSize']);
        $slideData->setHeadlineColor(
            $settings['headline_color'] === '' ? '#fff' :$settings['headline_color']
        );
        $slideData->setDescriptionAnimation(
            $slideData->getDescriptionAnimation() === '' ?
                $settings['descriptionAnimation'] : $slideData->getDescriptionAnimation()
        );
        $slideData->setDescriptionSize($settings['descriptionSize']);
        $slideData->setDescriptionColor(
            $settings['description_color'] === '' ? '#fff' : $settings['description_color']
        );
        $slideData->setButtonAnimation(
            $slideData->getButtonAnimation() === '' ?
                $settings['buttonAnimation'] : $slideData->getButtonAnimation()
        );
        $slideData->setButtonTextSize($settings['buttonTextSize']);
        $slideData->setButtonTextColor(
            $settings['button_text_color'] === '' ? '#fff' : $settings['button_text_color']
        );

        return $slideData;
    }

    /**
     * Custom and Frontend configuration
     *
     * @param array $settings
     * @return array
     */
    protected function customSettings(array $settings): array
    {
        $customSettings = [];
        switch ($settings['sliderLayout']) {
            case 'fullwidth':
                $customSettings['sliderLayout']['outerWrapClass'] = 'fullwidthbanner-container';
                $customSettings['sliderLayout']['innerWrapClass'] = 'fullwidthabanner';
                break;
            case 'fullscreen':
                $customSettings['sliderLayout']['outerWrapClass'] = 'fullwidthbanner-container';
                $customSettings['sliderLayout']['innerWrapClass'] = 'fullscreenbanner';
                break;
            default:
                $customSettings['sliderLayout']['outerWrap'] = '';
                $customSettings['sliderLayout']['innerWrap'] = '';
                break;
        }
        switch ($settings['arrowsStyle']) {
            case 'hades':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-arr-allwrapper"><div class="tp-arr-imgholder"></div></div>';
                break;
            case 'ares':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-title-wrap"><span class="tp-arr-titleholder">{{title}}</span></div>';
                break;
            case 'hebe':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-title-wrap"> <span class="tp-arr-titleholder">{{title}}</span><span class="tp-arr-imgholder"></span></div>';
                break;
            case 'hermes':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-arr-allwrapper"><div class="tp-arr-imgholder"></div><div class="tp-arr-titleholder">{{title}}</div></div>';
                break;
            case 'erinyen':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div><div class="tp-arr-img-over"></div><span class="tp-arr-titleholder">{{title}}</span></div>';
                break;
            case 'zeus':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div></div>';
                break;
            case 'dione':
                $customSettings['arrowsStyle']['tmp'] =
                '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>';
                break;
            default:
                $customSettings['arrowsStyle']['tmp'] = '';
                break;
        }
        if ($customSettings['arrowsStyle']['tmp'] !== '') {
            $customSettings['arrowsStyle']['tmp'] = "'" . $customSettings['arrowsStyle']['tmp'] . "'";
        }
        switch ($settings['bulletsStyle']) {
            case 'hades':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-image"></span>';
                break;
            case 'ares':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'hebe':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-image"></span>';
                break;
            case 'zeus':
                $customSettings['bulletsStyle']['tmp'] =
                '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'metis':
                $customSettings['bulletsStyle']['tmp'] =
                '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'dione':
                $customSettings['bulletsStyle']['tmp'] =
                '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'uranus':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-inner"></span>';
                break;
            default:
                $customSettings['bulletsStyle']['tmp'] = '';
                break;
        }
        if ($customSettings['bulletsStyle']['tmp'] !== '') {
            $customSettings['bulletsStyle']['tmp'] = "'" . $customSettings['bulletsStyle']['tmp'] . "'";
        }
        return $customSettings;
    }

    /**
     * @param array $settings
     * @return array
     */
    protected function handleSettings(array $settings): array
    {
        $settings['slideDuration'] = $settings['slide_duration'] ?? $settings['slideDuration'];
        $settings['slideEffect'] = $settings['slide_effect'] ?? $settings['slideEffect'];
        $settings['headlineAnimation'] = $settings['headline_animation'] ?? $settings['headlineAnimation'];
        $settings['descriptionAnimation'] = $settings['description_animation'] ?? $settings['descriptionAnimation'];
        $settings['buttonAnimation'] = $settings['button_animation'] ?? $settings['buttonAnimation'];

        $settings['headlineSize'] = "['" .
            $settings['headline_size_desktop'] . "', '" .
            $settings['headline_size_tablet'] . "', '" .
            $settings['headline_size_tablet'] . "', '" .
            $settings['headline_size_mobile'] . "']"
        ;
        $settings['descriptionSize'] = "['" .
            $settings['description_size_desktop'] . "','" .
            $settings['description_size_tablet'] . "','" .
            $settings['description_size_tablet'] . "','" .
            $settings['description_size_mobile'] . "']"
        ;
        $settings['buttonTextSize'] = "['" .
            $settings['button_text_size_desktop'] . "','" .
            $settings['button_text_size_tablet'] . "','" .
            $settings['button_text_size_tablet'] . "','" .
            $settings['button_text_size_mobile'] . "']"
        ;

        return $settings;
    }

    /**
     * @param array $files
     * @param string $type
     * @param string $path
     */
    protected function addAssets(array $files, string $type, string $path): void
    {
        foreach ($files as $file) {
            $pathInfo = pathinfo($file);
            if (GeneralUtility::inList($type, strtolower($pathInfo['extension']))) {
                switch ($type) {
                    case 'css':
                        $this->pageRenderer->addCssFile($path . $file);
                        break;
                    case 'js':
                        $this->pageRenderer->addJsFooterFile($path . $file);
                        break;
                    default:
                        break;
                }
            }
        }
    }
}
