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

use TYPO3\CMS\Core\Page\AssetCollector;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use NITSAN\NsRevolutionSlider\Domain\Repository\SliderRepository;
use NITSAN\NsRevolutionSlider\Domain\Repository\SlideItemRepository;
/**
 * SliderController
 * @extensionScannerIgnoreFile
 */
class SliderController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * sliderRepository
     *
     */
    protected $sliderRepository = null;

    /**
     * slideItemRepository
     *
     */
    protected $slideItemRepository = null;

    public function __construct(SliderRepository $sliderRepository, SlideItemRepository $slideItemRepository)
    {
        $this->sliderRepository = $sliderRepository;
        $this->slideItemRepository = $slideItemRepository;
    }

    /**
     * Init
     *
     * @return void
     */
    public function initializeAction(): void
    {
        $this->registerRevolutionSliderAssets($this->settings);
        parent::initializeAction();
    }

    /**
     * Registers Revolution Slider frontend assets for TYPO3 v12+.
     *
     * @param array<string, mixed> $settings
     */
    protected function registerRevolutionSliderAssets(array $settings): void
    {
        $assetCollector = GeneralUtility::makeInstance(AssetCollector::class);
        $publicPath = \TYPO3\CMS\Core\Core\Environment::getPublicPath();
        $jsFolderPath = rtrim((string)($settings['jsFolderPath'] ?? ''), '/') . '/';
        $cssFolderPath = rtrim((string)($settings['cssFolderPath'] ?? ''), '/') . '/';

        if ($settings['includeJquery'] ?? false) {
            $jQueryFile = (string)($settings['jQueryFile'] ?? 'Js/jquery-2.1.4.min.js');
            $assetCollector->addJavaScript(
                'js_file_' . md5($jQueryFile),
                'EXT:ns_revolution_slider/Resources/Public/' . ltrim($jQueryFile, '/')
            );
        }

        $javascript = [];
        $jsDirectory = $publicPath . '/' . $jsFolderPath;
        if (is_dir($jsDirectory)) {
            $javascript = GeneralUtility::getFilesInDir($jsDirectory);
            $extensionsPath = $jsDirectory . 'extensions/';
            if (is_dir($extensionsPath)) {
                $extensionFiles = GeneralUtility::getFilesInDir($extensionsPath);
                foreach ($extensionFiles as $extensionFile) {
                    $javascript[] = 'extensions/' . $extensionFile;
                }
            }
        }

        foreach ($this->sortRevolutionSliderJavaScriptFiles($javascript) as $file) {
            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'js') {
                continue;
            }
            $source = $jsFolderPath . $file;
            if (!is_file($publicPath . '/' . $source)) {
                continue;
            }
            $assetCollector->addJavaScript('js_' . md5($source), $source);
        }

        $cssDirectory = $publicPath . '/' . $cssFolderPath;
        if (is_dir($cssDirectory)) {
            foreach (GeneralUtility::getFilesInDir($cssDirectory) as $file) {
                if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'css') {
                    continue;
                }
                $source = $cssFolderPath . $file;
                if (!is_file($publicPath . '/' . $source)) {
                    continue;
                }
                $assetCollector->addStyleSheet('css_' . md5($source), $source);
            }
        }

        if (!empty($settings['customStyleFilePath']) && is_file($publicPath . '/' . ltrim((string)$settings['customStyleFilePath'], '/'))) {
            $assetCollector->addStyleSheet(
                'css_custom_' . md5((string)$settings['customStyleFilePath']),
                (string)$settings['customStyleFilePath']
            );
        }

        $navigationStyle = $settings['arrowsStyle'] ?? $settings['bulletsStyle'] ?? '';
        if ($navigationStyle !== '') {
            $navigationSkin = $cssFolderPath . 'navigation-skins/' . $navigationStyle . '.css';
            if (is_file($publicPath . '/' . $navigationSkin)) {
                $assetCollector->addStyleSheet('css_nav_' . md5($navigationSkin), $navigationSkin);
            }
        }
    }

    /**
     * action slider
     *
     */
    public function sliderAction()
    {
        $assetCollector = GeneralUtility::makeInstance(AssetCollector::class);
        $contentObj = $this->request->getAttribute('currentContentObject');
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
                        if ($slideData->getBoxCheck() && !$this->hasValidBoxPosition($slideData->getBoxPositionX())) {
                            $slideData->setBoxCheck(0);
                        }
                        if ($slides == false) {
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
                if ($slideData) {
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
                        if ($slide->getBoxCheck() && !$this->hasValidBoxPosition($slide->getBoxPositionX())) {
                            $slide->setBoxCheck(0);
                        }
                        if ($slides == false) {
                            $slides = array();
                        }
                        $slides[] = $slide;
                    }
                } else {
                    $slides = [];
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
           
            $uniqueId = $this->request->getControllerExtensionKey() . '_' . $uid . '_style';

            $assetCollector->addInlineStyleSheet(
                $uniqueId,
                $settings['customStyle']
            );
        }
        $uniqueId = $this->request->getControllerExtensionKey() . '_' . $uid;
        if (!$assetCollector->hasInlineJavaScript($uniqueId)) {
            $jsCode = $this->buildRevolutionSliderInitializationScript($uid, $settings, $customSettings);
            $assetCollector->addInlineJavaScript(
                $uniqueId,
                $jsCode,
                [],
                ['position' => 'footer']
            );
        }
        return $this->htmlResponse();
    }

    /**
     * @param array<string, mixed> $settings
     * @param array<string, mixed> $customSettings
     */
    protected function buildRevolutionSliderInitializationScript(int $uid, array $settings, array $customSettings): string
    {
        $jsFolderPath = addslashes((string)($settings['jsFolderPath'] ?? 'fileadmin/revolution-slider/js/'));
        $revolutionConfig = "sliderLayout: '" . $settings['sliderLayout'] . "',
                                sliderType: 'standard',
                                shadow: '" . (isset($settings['shadow']) && $settings['shadow'] !== '' ? 'spinner1' : 'spinner0') . "',
                                spinner: '" . ($settings['spinner'] ? 'spinner3' : 'off') . "',
                                stopLoop: '" . ($settings['stopLoop'] ? 'on' : 'off') . "',
                                stopAfterLoops: " . ($settings['stopLoop'] ? 0 : -1) . ',
                                stopAtSlide: ' . (isset($settings['stopAtSlide']) && $settings['stopAtSlide'] !== '' && $settings['stopAtSlide'] !== '-1' && $settings['stopAtSlide'] !== '0' && $settings['stopLoop'] ? $settings['stopAtSlide'] : -1) . ',
                                ' . (isset($settings['slideDuration']) && $settings['slideDuration'] !== '' ? 'delay: ' . $settings['slideDuration'] . ',' : '') . '
                                responsiveLevels: [' . (isset($settings['responsiveLevels']) && $settings['responsiveLevels'] !== '' ? $settings['responsiveLevels'] : '') . '],
                                visibilityLevels: [' . (isset($settings['visibilityLevels']) && $settings['visibilityLevels'] !== '' ? $settings['visibilityLevels'] : '') . '],
                                gridwidth: [' . (isset($settings['gridwidth']) && $settings['gridwidth'] !== '' ? $settings['gridwidth'] : '') . '],
                                gridheight: [' . (isset($settings['gridheight']) && $settings['gridheight'] !== '' ? $settings['gridheight'] : '') . '],
                                hideSliderAtLimit: ' . (isset($settings['hideSliderAtLimit']) && $settings['hideSliderAtLimit'] !== '' ? $settings['hideSliderAtLimit'] : 0) . ',
                                debugMode: ' . ($settings['debugMode'] ? 'true' : 'false') . ",
                                onInit: function() {
                                    jQuery('#rev_slider_" . $uid . "').removeClass('revslider-pending');
                                },

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
                                }";

        return "function nsRevolutionSliderInit_" . $uid . "() {
    var \$slider = jQuery('#rev_slider_" . $uid . "');
    if (!\$slider.length) {
        return;
    }
    if (typeof jQuery.fn.revolution !== 'function') {
        console.error('[ns_revolution_slider] Revolution Slider library not loaded. Install JS/CSS to " . $jsFolderPath . "');
        return;
    }
    \$slider.show();
    \$slider.revolution({
                                " . $revolutionConfig . "
                            });
    \$slider.removeClass('revslider-pending');
}
if (document.readyState === 'complete') {
    nsRevolutionSliderInit_" . $uid . "();
} else {
    window.addEventListener('load', nsRevolutionSliderInit_" . $uid . ");
}";
    }

    protected function hasValidBoxPosition(string $position): bool
    {
        $position = trim($position);
        if ($position === '') {
            return false;
        }

        return str_starts_with($position, '[') || is_numeric($position);
    }

    /**
     * Revolution Slider requires tools.min.js before revolution.min.js.
     *
     * @param array<int, string> $files
     * @return array<int, string>
     */
    protected function sortRevolutionSliderJavaScriptFiles(array $files): array
    {
        $skip = [
            'index.php',
            'jquery.themepunch.enablelog.js',
            'tp-color-picker.min.js',
        ];
        $priority = [
            'jquery.themepunch.tools.min.js',
            'jquery.themepunch.revolution.min.js',
            'extensions/revolution.extension.slideanims.min.js',
            'extensions/revolution.extension.layeranimation.min.js',
            'extensions/revolution.extension.navigation.min.js',
        ];
        $ordered = [];
        foreach ($priority as $file) {
            if (in_array($file, $files, true)) {
                $ordered[] = $file;
            }
        }
        foreach ($files as $file) {
            if (in_array($file, $skip, true) || in_array($file, $ordered, true)) {
                continue;
            }
            if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) === 'js') {
                $ordered[] = $file;
            }
        }

        return $ordered;
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
