<?php
namespace NITSAN\NsRevolutionSlider\Controller;

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

use NITSAN\NsRevolutionSlider\Domain\Repository\SlideItemRepository;
use NITSAN\NsRevolutionSlider\Domain\Repository\SliderRepository;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * SliderController
 */
class SliderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * sliderRepository
     *
     * @var SliderRepository
     */
    protected $sliderRepository = null;

    /**
     * slideItemRepository
     *
     * @var SlideItemRepository
     */
    protected $slideItemRepository = null;

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

    protected $pageRenderer;

    /**
     * Init
     *
     * @return void
     */
    public function initializeAction()
    {
        //Fetch current record information
        $this->pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        //Plug-in settings
        $settings = $this->settings;
        //Javascript and CSS files fetch from folder
        
        $javascript = GeneralUtility::getFilesInDir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $settings['jsFolderPath']);
        $css = GeneralUtility::getFilesInDir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $settings['cssFolderPath']);
        
        if ($settings['includeJquery']) {
            $this->pageRenderer->addJsFooterFile($settings['jQueryFile']);
        }
        foreach ($javascript as $fileKey => $file) {
            $pathinfo = pathinfo($file);
            if (GeneralUtility::inList('js', strtolower($pathinfo['extension']))) {
                $js = $settings['jsFolderPath'] . $file;
                $this->pageRenderer->addJsFooterFile($js);
                unset($js);
            }
        }
        foreach ($css as $fileKey => $file) {
            $pathinfo = pathinfo($file);
            if (GeneralUtility::inList('css', strtolower($pathinfo['extension']))) {
                $css = $settings['cssFolderPath'] . $file;
                $this->pageRenderer->addCssFile($css);
                unset($css);
            }
        }
        if ($settings['customStyleFilePath']) {
            $this->pageRenderer->addCssFile($settings['customStyleFilePath']);
        }
        parent::initializeAction();
    }

    /**
     * action slider
     *
     * @return void
     */
    public function sliderAction()
    {
        $contentObj = $this->configurationManager->getContentObject();
        $uid = $contentObj->data['uid'];
        //Plug-in settings
        $settings = $this->settings;
        $customSettings = $this->customSettings($settings);
        //Global animation configuration updated base on plug-in settings
        $settings['slideDuration'] = ($settings['slide_duration'] ? $settings['slide_duration'] : $settings['slideDuration']);
        $settings['slideEffect'] = ($settings['slide_effect'] ? $settings['slide_effect'] : $settings['slideEffect']);
        $settings['headlineAnimation'] = ($settings['headline_animation'] ? $settings['headline_animation'] : $settings['headlineAnimation']);
        $settings['descriptionAnimation'] = ($settings['description_animation'] ? $settings['description_animation'] : $settings['descriptionAnimation']);
        $settings['buttonAnimation'] = ($settings['button_animation'] ? $settings['button_animation'] : $settings['buttonAnimation']);

        $settings['headlineSize'] = "['" . $settings['headline_size_desktop'] . "', '" . $settings['headline_size_tablet'] . "', '" . $settings['headline_size_tablet'] . "', '" . $settings['headline_size_mobile'] . "']";
        $settings['descriptionSize'] = "['" . $settings['description_size_desktop'] . "','" . $settings['description_size_tablet'] . "','" . $settings['description_size_tablet'] . "','" . $settings['description_size_mobile'] . "']";
        $settings['buttonTextSize'] = "['" . $settings['button_text_size_desktop'] . "','" . $settings['button_text_size_tablet'] . "','" . $settings['button_text_size_tablet'] . "','" . $settings['button_text_size_mobile'] . "']";

        //Slider logic
        $slides = false;
        if ($settings['slides_type']) {
            //Slider type => individual slide items
            if ($settings['slides'] != '') {
                $slidesUids = explode(',', $settings['slides']);
                foreach ($slidesUids as $slide) {
                    $slideData = $this->slideItemRepository->findByUid($slide);
                    if ($slideData) {
                        //Animation Configuration updated base on Slide
                        $slideData->setSlideEffect(($slideData->getSlideEffect() ? $slideData->getSlideEffect() : $settings['slideEffect']));
                        //Headline Configuration
                        $slideData->setHeadlineAnimation(($slideData->getHeadlineAnimation() ? $slideData->getHeadlineAnimation() : $settings['headlineAnimation']));
                        $slideData->setHeadlineSize($settings['headlineSize']);
                        $slideData->setHeadlineColor(($settings['headline_color'] !== '' ? $settings['headline_color'] : '#fff'));
                        //Description Configuration
                        $slideData->setDescriptionAnimation(($slideData->getDescriptionAnimation() ? $slideData->getDescriptionAnimation() : $settings['descriptionAnimation']));
                        $slideData->setDescriptionSize($settings['descriptionSize']);
                        $slideData->setDescriptionColor(($settings['description_color'] !== '' ? $settings['description_color'] : '#fff'));
                        //Button Configuration
                        $slideData->setButtonAnimation(($slideData->getButtonAnimation() ? $slideData->getButtonAnimation() : $settings['buttonAnimation']));
                        $slideData->setButtonTextSize($settings['buttonTextSize']);
                        $slideData->setButtonTextColor(($settings['button_text_color'] !== '' ? $settings['button_text_color'] : '#fff'));
                        if($slides == false){
                            $slides = array();
                        }
                        $slides[] = $slideData;
                    }
                }
            }
        } else {
            //Slider type => Whole Slider
            if ($settings['slider']) {
                $slideData = $this->sliderRepository->findByUid($settings['slider']);
                if($slideData){
                    foreach ($slideData->getSlides() as $slide) {
                        //Animation Configuration updated base on Slide
                        $slide->setSlideEffect(($slide->getSlideEffect() ? $slide->getSlideEffect() : $settings['slideEffect']));
                        //Headline Configuration
                        $slide->setHeadlineAnimation(($slide->getHeadlineAnimation() ? $slide->getHeadlineAnimation() : $settings['headlineAnimation']));
                        $slide->setHeadlineSize($settings['headlineSize']);
                        $slide->setHeadlineColor(($settings['headline_color'] !== '' ? $settings['headline_color'] : '#fff'));
                        //Description Configuration
                        $slide->setDescriptionAnimation(($slide->getDescriptionAnimation() ? $slide->getDescriptionAnimation() : $settings['descriptionAnimation']));
                        $slide->setDescriptionSize($settings['descriptionSize']);
                        $slide->setDescriptionColor(($settings['description_color'] !== '' ? $settings['description_color'] : '#fff'));
                        //Button Configuration
                        $slide->setButtonAnimation(($slide->getButtonAnimation() ? $slide->getButtonAnimation() : $settings['buttonAnimation']));
                        $slide->setButtonTextSize($settings['buttonTextSize']);
                        $slide->setButtonTextColor(($settings['button_text_color'] !== '' ? $settings['button_text_color'] : '#fff'));
                        if($slides == false){
                            $slides = array();
                        }
                        $slides[] = $slide;
                    }
                }else {
                    $slides[] = [];
                }
            }
        }

        $this->view->assignMultiple(
            [
                'feSettings' => $customSettings,
                'uid' => $uid,
                'slides' => $slides
            ]
        );
        $settings['customStyle'] = isset($settings['customStyle']) ? $settings['customStyle'] : '';
        if ($settings['customStyle']) {
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . '_' . $uid . '_style'] .= "<style type='text/css'>"
            . $settings['customStyle'] .
            '</style>';
        }
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] = isset($GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid]) ? $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] : '';
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] .= "
            <script type='text/javascript'>
                jQuery('#rev_slider_" . $uid . "').show().revolution({
                    sliderLayout: '" . $settings['sliderLayout'] . "',
                    sliderType: 'standard',
                    shadow: '" . (isset($settings['shadow']) && $settings['shadow'] !== '' ? 'spinner1' : 'spinner0') . "',
                    spinner: '" . ($settings['spinner'] ? 'spinner3' : 'off') . "',
                    stopLoop: '" . ($settings['stopLoop'] ? 'on' : 'off') . "',
                    stopAfterLoops: " . ($settings['stopLoop'] ? 0 : -1) . ',
                    stopAtSlide: ' . (isset($settings['stopAtSlide']) && $settings['stopAtSlide'] !== '' && $settings['stopAtSlide'] !== '-1' && $settings['stopAtSlide'] !== '0' && $settings['stopLoop'] ? $settings['stopAtSlide'] : -1) . ',
                    ' . (isset($settings['slideDuration']) && $settings['slideDuration'] !== '' ? 'delay: ' . $settings['slideDuration'] . ',': '') . '
                    responsiveLevels: [' . (isset($settings['responsiveLevels']) && $settings['responsiveLevels'] !== '' ? $settings['responsiveLevels'] : '') . '],
                    visibilityLevels: [' . (isset($settings['visibilityLevels']) && $settings['visibilityLevels'] !== '' ? $settings['visibilityLevels'] : '') . '],
                    gridwidth: [' . (isset($settings['gridwidth']) && $settings['gridwidth'] !== '' ? $settings['gridwidth'] : '') . '],
                    gridheight: [' . (isset($settings['gridheight']) && $settings['gridheight'] !== '' ? $settings['gridheight'] : '') . '],
                    hideSliderAtLimit: ' . (isset($settings['hideSliderAtLimit']) && $settings['hideSliderAtLimit'] !== '' ? $settings['hideSliderAtLimit'] : 0) . ',
                    debugMode: ' . ($settings['debugMode'] ? 'true' : 'false') . ",
                    
                    /* basic navigation arrows and bullets */
                    navigation: {
                        keyboardNavigation: '" . ($settings['keyboardNavigation'] ? 'on' : 'off') . "',
                        keyboard_direction: '" . $settings['keyboard_direction'] . "',
                        mouseScrollNavigation: '" . ($settings['mouseScrollNavigation'] ? 'on' : 'off') . "',
                        onHoverStop: '" . ($settings['onHoverStop'] ? 'on' : 'off') . "',
                        touch: {
                            touchenabled: '" . ($settings['touchenabled'] ? 'on' : 'off') . "',
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: 'horizontal',
                            drag_block_vertical: true
                        },
                        arrows: {
                            enable: " . ($settings['arrowsEnable'] ? 'true' : 'false') . ',
                            hide_onleave: ' . ($settings['arrowsHideOnleave'] ? 'true' : 'false') . ",
                            style: '" . $settings['arrowsStyle'] . "'
                            " . ($customSettings['arrowsStyle']['tmp'] !== '' ? ', tmp: ' . $customSettings['arrowsStyle']['tmp'] : '') . '
                        },
                        bullets: {
                            enable: ' . ($settings['bulletsEnable'] ? 'true' : 'false') . ",
                            hide_onleave: false,
                            style: '" . $settings['bulletsStyle'] . "',
                            " . ($customSettings['bulletsStyle']['tmp'] !== '' ? 'tmp: ' . $customSettings['bulletsStyle']['tmp'] . ',' : '') . "
                            h_align: 'center',
                            v_align: 'bottom',
                            h_offset: 0,
                            v_offset: 20,
                            space: 5
                        }
                    }
                });
            </script>
        ";

        return $this->htmlResponse();
    }

    /**
     * Custom and Frontend configuration
     *
     * @param array $settings
     *
     * @return array
     */
    public function customSettings(array $settings)
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
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-arr-allwrapper"><div class="tp-arr-imgholder"></div></div>';
                break;
            case 'ares':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-title-wrap"><span class="tp-arr-titleholder">{{title}}</span></div>';
                break;
            case 'hebe':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-title-wrap"> <span class="tp-arr-titleholder">{{title}}</span><span class="tp-arr-imgholder"></span></div>';
                break;
            case 'hermes':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-arr-allwrapper"><div class="tp-arr-imgholder"></div><div class="tp-arr-titleholder">{{title}}</div></div>';
                break;
            case 'erinyen':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div><div class="tp-arr-img-over"></div><span class="tp-arr-titleholder">{{title}}</span></div>';
                break;
            case 'zeus':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-title-wrap"><div class="tp-arr-imgholder"></div></div>';
                break;
            case 'dione':
                $customSettings['arrowsStyle']['tmp'] = '<div class="tp-arr-imgwrapper"><div class="tp-arr-imgholder"></div></div>';
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
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'metis':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>';
                break;
            case 'dione':
                $customSettings['bulletsStyle']['tmp'] = '<span class="tp-bullet-img-wrap"><span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>';
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
}
