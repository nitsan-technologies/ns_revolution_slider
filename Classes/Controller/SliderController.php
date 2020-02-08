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

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\Inject as inject;

/**
 * SliderController
 */
class SliderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * sliderRepository
     *
     * @var \NITSAN\NsRevolutionSlider\Domain\Repository\SliderRepository
     * @inject
     */
    protected $sliderRepository = null;

    /**
     * slideItemRepository
     *
     * @var \NITSAN\NsRevolutionSlider\Domain\Repository\SlideItemRepository
     * @inject
     */
    protected $slideItemRepository = null;

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

        if (version_compare(TYPO3_branch, '9.0', '>')) {
            $javascript = GeneralUtility::getFilesInDir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $settings['jsFolderPath']);
            $css = GeneralUtility::getFilesInDir(\TYPO3\CMS\Core\Core\Environment::getPublicPath() . '/' . $settings['cssFolderPath']);
        } else {
            $javascript = GeneralUtility::getFilesInDir(PATH_site . $settings['jsFolderPath']);
            $css = GeneralUtility::getFilesInDir(PATH_site . $settings['cssFolderPath']);
        }
        $jsFiles = [];
        $cssFiles = [];
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
        $this->contentObj = $this->configurationManager->getContentObject();
        $uid = $this->contentObj->data['uid'];
        //Plug-in settings
        $settings = $this->settings;
        //Global animation configuration updated base on plug-in settings
        $settings['slideDuration'] = ($settings['slide_duration'] ? $settings['slide_duration'] : $settings['slideDuration']);
        $settings['slideEffect'] = ($settings['slide_effect'] ? $settings['slide_effect'] : $settings['slideEffect']);
        $settings['headlineAnimation'] = ($settings['headline_animation'] ? $settings['headline_animation'] : $settings['headlineAnimation']);
        $settings['descriptionAnimation'] = ($settings['description_animation'] ? $settings['description_animation'] : $settings['descriptionAnimation']);
        $settings['buttonAnimation'] = ($settings['button_animation'] ? $settings['button_animation'] : $settings['buttonAnimation']);
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
                        $slides[] = $slideData;
                    }
                }
            }
        } else {
            //Slider type => Whole Slider
            if ($settings['slider']) {
                $slideData = $this->sliderRepository->findByUid($settings['slider']);
                foreach ($slideData->getSlides() as $slide) {
                    //Animation Configuration updated base on Slide
                    $slide->setSlideEffect(($slide->getSlideEffect() ? $slide->getSlideEffect() : $settings['slideEffect']));
                    $slides[] = $slide;
                }
            }
        }

        $this->view->assignMultiple(
            [
                'uid' => $uid,
                'slides' => $slides
            ]
        );
        if ($settings['customStyle']) {
            $GLOBALS['TSFE']->additionalHeaderData[$this->request->getControllerExtensionKey() . '_' . $uid . '_style'] .= "<style type='text/css'>"
            . $settings['customStyle'] .
            '</style>';
        }
        $GLOBALS['TSFE']->additionalFooterData[$this->request->getControllerExtensionKey() . '_' . $uid] .= "
            <script type='text/javascript'>
                jQuery('#rev_slider_" . $uid . "').show().revolution({
                    sliderLayout: 'auto',
                    sliderType: 'standard',
                    shadow: " . (isset($settings['shadow']) && $settings['shadow'] !== '' ? $settings['shadow'] : 0) . ",
                    spinner: '" . ($settings['spinner'] ? 'spinner3' : 'off') . "',
                    stopLoop: '" . ($settings['stopLoop'] ? 'on' : 'off') . "',
                    stopAtSlide: " . (isset($settings['stopAtSlide']) && $settings['stopAtSlide'] !== '' && $settings['stopAtSlide'] !== '0' && $settings['stopAtSlide'] !== '-1' ? $settings['stopAtSlide'] : 0) . ",
                    " . (isset($settings['slideDelay']) && $settings['slideDelay'] !== '' ? 'delay: ' . $settings['slideDelay'] . ',': '') . "
                    responsiveLevels: [" . (isset($settings['responsiveLevels']) && $settings['responsiveLevels'] !== '' ? $settings['responsiveLevels'] : '') . "],
                    visibilityLevels: [" . (isset($settings['visibilityLevels']) && $settings['visibilityLevels'] !== '' ? $settings['visibilityLevels'] : '') . "],
                    gridwidth: [" . (isset($settings['gridwidth']) && $settings['gridwidth'] !== '' ? $settings['gridwidth'] : '') . "],
                    gridheight: [" . (isset($settings['gridheight']) && $settings['gridheight'] !== '' ? $settings['gridheight'] : '') . "],
                    hideSliderAtLimit: " . (isset($settings['hideSliderAtLimit']) && $settings['hideSliderAtLimit'] !== '' ? $settings['hideSliderAtLimit'] : 0) . ",
                    debugMode: " . ($settings['debugMode'] ? 'true' : 'false') . ",
                    
                    /* basic navigation arrows and bullets */
                    navigation: {
                        keyboardNavigation: 'true',
                        keyboard_direction: 'horizontal',
                        mouseScrollNavigation: '" . ($settings['mouseScrollNavigation'] ? 'on' : 'off') . "',
                        onHoverStop: '" . ($settings['onHoverStop'] ? 'on' : 'off') . "',
                        touch: {
                            touchenabled: 'on',
                            swipe_threshold: 75,
                            swipe_min_touches: 1,
                            swipe_direction: 'horizontal',
                            drag_block_vertical: true
                        },
                        arrows: {
                            enable: true,
                            hide_onleave: false,
                            style: 'hesperiden',
                        },
                        bullets: {
                            enable: true,
                            hide_onleave: false,
                            style: 'hesperiden',
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
    }
}
