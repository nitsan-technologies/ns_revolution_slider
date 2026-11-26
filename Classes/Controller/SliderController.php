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

use TYPO3\CMS\Core\Core\Environment;
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
    private const DEFAULT_JQUERY_FILE = 'Js/jquery-3.7.1.min.js';

    /**
     * Legacy TypoScript path; mapped to the current bundled file.
     */
    private const LEGACY_JQUERY_FILE = 'Js/jquery-2.1.4.min.js';

    private const ALLOWED_SLIDER_LAYOUTS = ['auto', 'fullwidth', 'fullscreen'];

    private const ALLOWED_KEYBOARD_DIRECTIONS = ['horizontal', 'vertical'];

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
        $publicPath = Environment::getPublicPath();
        $jsFolderPath = $this->normalizePublicRelativeDirectory((string)($settings['jsFolderPath'] ?? ''), $publicPath);
        $cssFolderPath = $this->normalizePublicRelativeDirectory((string)($settings['cssFolderPath'] ?? ''), $publicPath);

        if ($settings['includeJquery'] ?? false) {
            $jQueryFile = $this->normalizeExtensionPublicRelativeFile(
                (string)($settings['jQueryFile'] ?? self::DEFAULT_JQUERY_FILE)
            );
            $assetCollector->addJavaScript(
                'js_file_' . md5($jQueryFile),
                'EXT:ns_revolution_slider/Resources/Public/' . $jQueryFile
            );
        }

        $javascript = [];
        if ($jsFolderPath !== null) {
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
                if (str_contains($file, '..')) {
                    continue;
                }
                $source = $jsFolderPath . $file;
                if (!is_file($publicPath . '/' . $source)) {
                    continue;
                }
                $assetCollector->addJavaScript('js_' . md5($source), $source);
            }
        }

        if ($cssFolderPath !== null) {
            $cssDirectory = $publicPath . '/' . $cssFolderPath;
            if (is_dir($cssDirectory)) {
                foreach (GeneralUtility::getFilesInDir($cssDirectory) as $file) {
                    if (strtolower(pathinfo($file, PATHINFO_EXTENSION)) !== 'css') {
                        continue;
                    }
                    if (str_contains($file, '..')) {
                        continue;
                    }
                    $source = $cssFolderPath . $file;
                    if (!is_file($publicPath . '/' . $source)) {
                        continue;
                    }
                    $assetCollector->addStyleSheet('css_' . md5($source), $source);
                }
            }
        }

        $customStyleFilePath = $this->normalizePublicRelativeFile(
            (string)($settings['customStyleFilePath'] ?? ''),
            $publicPath
        );
        if ($customStyleFilePath !== null) {
            $assetCollector->addStyleSheet(
                'css_custom_' . md5($customStyleFilePath),
                $customStyleFilePath
            );
        }

        $navigationStyle = $this->sanitizeNavStyle(
            (string)($settings['arrowsStyle'] ?? $settings['bulletsStyle'] ?? '')
        );
        if ($navigationStyle !== '' && $cssFolderPath !== null) {
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
        if ($contentObj === null) {
            return $this->htmlResponse('');
        }
        $uid = (int)($contentObj->data['uid'] ?? 0);
        //Plug-in settings
        $settings = $this->settings;
        $customSettings = $this->customSettings($settings);
        //Global animation configuration updated base on plug-in settings
        $settings['slideDuration'] = ($settings['slide_duration'] ?? false) ? $settings['slide_duration'] : ($settings['slideDuration'] ?? '');
        $settings['slideEffect'] = ($settings['slide_effect'] ?? false) ? $settings['slide_effect'] : ($settings['slideEffect'] ?? '');
        $settings['headlineAnimation'] = ($settings['headline_animation'] ?? false) ? $settings['headline_animation'] : ($settings['headlineAnimation'] ?? '');
        $settings['descriptionAnimation'] = ($settings['description_animation'] ?? false) ? $settings['description_animation'] : ($settings['descriptionAnimation'] ?? '');
        $settings['buttonAnimation'] = ($settings['button_animation'] ?? false) ? $settings['button_animation'] : ($settings['buttonAnimation'] ?? '');

        $settings['headlineSize'] = "['" . ($settings['headline_size_desktop'] ?? '') . "', '" . ($settings['headline_size_tablet'] ?? '') . "', '" . ($settings['headline_size_tablet'] ?? '') . "', '" . ($settings['headline_size_mobile'] ?? '') . "']";
        $settings['descriptionSize'] = "['" . ($settings['description_size_desktop'] ?? '') . "','" . ($settings['description_size_tablet'] ?? '') . "','" . ($settings['description_size_tablet'] ?? '') . "','" . ($settings['description_size_mobile'] ?? '') . "']";
        $settings['buttonTextSize'] = "['" . ($settings['button_text_size_desktop'] ?? '') . "','" . ($settings['button_text_size_tablet'] ?? '') . "','" . ($settings['button_text_size_tablet'] ?? '') . "','" . ($settings['button_text_size_mobile'] ?? '') . "']";

        //Slider logic
        $slides = false;
        if (!empty($settings['slides_type'])) {
            //Slider type => individual slide items
            if (($settings['slides'] ?? '') != '') {
                $slidesUids = explode(',', (string)$settings['slides']);
                foreach ($slidesUids as $slide) {
                    $slideUid = (int)$slide;
                    if ($slideUid <= 0) {
                        continue;
                    }
                    $slideData = $this->slideItemRepository->findByUid($slideUid);
                    if ($slideData) {
                        //Animation Configuration updated base on Slide
                        $slideData->setSlideEffect(($slideData->getSlideEffect() ? $slideData->getSlideEffect() : $settings['slideEffect']));
                        //Headline Configuration
                        $slideData->setHeadlineAnimation(($slideData->getHeadlineAnimation() ? $slideData->getHeadlineAnimation() : $settings['headlineAnimation']));
                        $slideData->setHeadlineSize($settings['headlineSize']);
                        $slideData->setHeadlineColor((($settings['headline_color'] ?? '') !== '') ? $settings['headline_color'] : '#fff');
                        //Description Configuration
                        $slideData->setDescriptionAnimation(($slideData->getDescriptionAnimation() ? $slideData->getDescriptionAnimation() : $settings['descriptionAnimation']));
                        $slideData->setDescriptionSize($settings['descriptionSize']);
                        $slideData->setDescriptionColor((($settings['description_color'] ?? '') !== '') ? $settings['description_color'] : '#fff');
                        //Button Configuration
                        $slideData->setButtonAnimation(($slideData->getButtonAnimation() ? $slideData->getButtonAnimation() : $settings['buttonAnimation']));
                        $slideData->setButtonTextSize($settings['buttonTextSize']);
                        $slideData->setButtonTextColor((($settings['button_text_color'] ?? '') !== '') ? $settings['button_text_color'] : '#fff');
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
            if (!empty($settings['slider'])) {
                $slideData = $this->sliderRepository->findByUid((int)$settings['slider']);
                if ($slideData) {
                    foreach ($slideData->getSlides() as $slide) {
                        //Animation Configuration updated base on Slide
                        $slide->setSlideEffect(($slide->getSlideEffect() ? $slide->getSlideEffect() : $settings['slideEffect']));
                        //Headline Configuration
                        $slide->setHeadlineAnimation(($slide->getHeadlineAnimation() ? $slide->getHeadlineAnimation() : $settings['headlineAnimation']));
                        $slide->setHeadlineSize($settings['headlineSize']);
                        $slide->setHeadlineColor((($settings['headline_color'] ?? '') !== '') ? $settings['headline_color'] : '#fff');
                        //Description Configuration
                        $slide->setDescriptionAnimation(($slide->getDescriptionAnimation() ? $slide->getDescriptionAnimation() : $settings['descriptionAnimation']));
                        $slide->setDescriptionSize($settings['descriptionSize']);
                        $slide->setDescriptionColor((($settings['description_color'] ?? '') !== '') ? $settings['description_color'] : '#fff');
                        //Button Configuration
                        $slide->setButtonAnimation(($slide->getButtonAnimation() ? $slide->getButtonAnimation() : $settings['buttonAnimation']));
                        $slide->setButtonTextSize($settings['buttonTextSize']);
                        $slide->setButtonTextColor((($settings['button_text_color'] ?? '') !== '') ? $settings['button_text_color'] : '#fff');
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
        $jsFolderPath = (string)($settings['jsFolderPath'] ?? 'fileadmin/revolution-slider/js/');
        $stopAtSlide = -1;
        if (
            !empty($settings['stopLoop'])
            && isset($settings['stopAtSlide'])
            && $settings['stopAtSlide'] !== ''
            && $settings['stopAtSlide'] !== '-1'
            && $settings['stopAtSlide'] !== '0'
        ) {
            $parsedStopAtSlide = $this->sanitizeInteger($settings['stopAtSlide']);
            if ($parsedStopAtSlide !== null && $parsedStopAtSlide > 0) {
                $stopAtSlide = $parsedStopAtSlide;
            }
        }

        $config = [
            'sliderLayout' => $this->sanitizeSelect(
                (string)($settings['sliderLayout'] ?? 'auto'),
                self::ALLOWED_SLIDER_LAYOUTS,
                'auto'
            ),
            'sliderType' => 'standard',
            'shadow' => (isset($settings['shadow']) && $settings['shadow'] !== '') ? 'spinner1' : 'spinner0',
            'spinner' => !empty($settings['spinner']) ? 'spinner3' : 'off',
            'stopLoop' => !empty($settings['stopLoop']) ? 'on' : 'off',
            'stopAfterLoops' => !empty($settings['stopLoop']) ? 0 : -1,
            'stopAtSlide' => $stopAtSlide,
            'responsiveLevels' => $this->sanitizeIntegerList($settings['responsiveLevels'] ?? ''),
            'visibilityLevels' => $this->sanitizeIntegerList($settings['visibilityLevels'] ?? ''),
            'gridwidth' => $this->sanitizeIntegerList($settings['gridwidth'] ?? ''),
            'gridheight' => $this->sanitizeIntegerList($settings['gridheight'] ?? ''),
            'hideSliderAtLimit' => $this->sanitizeInteger($settings['hideSliderAtLimit'] ?? 0) ?? 0,
            'debugMode' => !empty($settings['debugMode']),
            'navigation' => [
                'keyboardNavigation' => !empty($settings['keyboardNavigation']) ? 'on' : 'off',
                'keyboard_direction' => $this->sanitizeSelect(
                    (string)($settings['keyboard_direction'] ?? 'horizontal'),
                    self::ALLOWED_KEYBOARD_DIRECTIONS,
                    'horizontal'
                ),
                'mouseScrollNavigation' => !empty($settings['mouseScrollNavigation']) ? 'on' : 'off',
                'onHoverStop' => !empty($settings['onHoverStop']) ? 'on' : 'off',
                'touch' => [
                    'touchenabled' => !empty($settings['touchenabled']) ? 'on' : 'off',
                    'swipe_threshold' => 75,
                    'swipe_min_touches' => 1,
                    'swipe_direction' => 'horizontal',
                    'drag_block_vertical' => true,
                ],
                'arrows' => [
                    'enable' => !empty($settings['arrowsEnable']),
                    'hide_onleave' => !empty($settings['arrowsHideOnleave']),
                    'style' => $this->sanitizeNavStyle((string)($settings['arrowsStyle'] ?? '')),
                ],
                'bullets' => [
                    'enable' => !empty($settings['bulletsEnable']),
                    'hide_onleave' => false,
                    'style' => $this->sanitizeNavStyle((string)($settings['bulletsStyle'] ?? '')),
                    'h_align' => 'center',
                    'v_align' => 'bottom',
                    'h_offset' => 0,
                    'v_offset' => 20,
                    'space' => 5,
                ],
            ],
        ];

        if (isset($settings['slideDuration']) && $settings['slideDuration'] !== '') {
            $delay = $this->sanitizeInteger($settings['slideDuration']);
            if ($delay !== null && $delay > 0) {
                $config['delay'] = $delay;
            }
        }

        $arrowsTmp = (string)($customSettings['arrowsStyle']['tmp'] ?? '');
        if ($arrowsTmp !== '') {
            $config['navigation']['arrows']['tmp'] = $arrowsTmp;
        }
        $bulletsTmp = (string)($customSettings['bulletsStyle']['tmp'] ?? '');
        if ($bulletsTmp !== '') {
            $config['navigation']['bullets']['tmp'] = $bulletsTmp;
        }

        $configJson = json_encode(
            $config,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
        );
        if ($configJson === false) {
            $configJson = '{}';
        }

        $jsFolderPathJson = json_encode(
            $jsFolderPath,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
        );
        if ($jsFolderPathJson === false) {
            $jsFolderPathJson = '""';
        }

        return 'function nsRevolutionSliderInit_' . $uid . '() {
    var $slider = jQuery("#rev_slider_' . $uid . '");
    if (!$slider.length) {
        return;
    }
    if (typeof jQuery.fn.revolution !== "function") {
        console.error("[ns_revolution_slider] Revolution Slider library not loaded. Install JS/CSS to " + ' . $jsFolderPathJson . ');
        $slider.removeClass("revslider-pending").addClass("revslider-fallback").show();
        return;
    }
    var config = ' . $configJson . ';
    config.onInit = function() {
        jQuery("#rev_slider_' . $uid . '").removeClass("revslider-pending");
    };
    $slider.show();
    $slider.revolution(config);
    $slider.removeClass("revslider-pending");
}
if (document.readyState === "complete") {
    nsRevolutionSliderInit_' . $uid . '();
} else {
    window.addEventListener("load", nsRevolutionSliderInit_' . $uid . ');
}';
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
     * Reject empty paths (would scan the public root) and path traversal.
     * Keeps normal relative folders such as fileadmin/revolution-slider/js/.
     */
    protected function normalizePublicRelativeDirectory(string $path, string $publicPath): ?string
    {
        $path = str_replace('\\', '/', trim($path));
        $path = trim($path, '/');
        if ($path === '' || str_contains($path, "\0") || preg_match('#(^|/)\.\.(/|$)#', $path) === 1) {
            return null;
        }

        $absolute = $publicPath . '/' . $path;
        if (!is_dir($absolute)) {
            return null;
        }

        $realDir = realpath($absolute);
        $realPublic = realpath($publicPath);
        if ($realDir === false || $realPublic === false) {
            return null;
        }
        if ($realDir === $realPublic) {
            return null;
        }
        if (!str_starts_with($realDir, $realPublic . DIRECTORY_SEPARATOR)) {
            return null;
        }

        $relative = substr($realDir, strlen($realPublic) + 1);

        return str_replace('\\', '/', $relative) . '/';
    }

    /**
     * Keep custom CSS file paths under the public web path without traversal.
     */
    protected function normalizePublicRelativeFile(string $path, string $publicPath): ?string
    {
        $path = str_replace('\\', '/', trim($path));
        $path = ltrim($path, '/');
        if ($path === '' || str_contains($path, "\0") || preg_match('#(^|/)\.\.(/|$)#', $path) === 1) {
            return null;
        }

        $absolute = $publicPath . '/' . $path;
        if (!is_file($absolute)) {
            return null;
        }

        $realFile = realpath($absolute);
        $realPublic = realpath($publicPath);
        if ($realFile === false || $realPublic === false) {
            return null;
        }
        if (!str_starts_with($realFile, $realPublic . DIRECTORY_SEPARATOR)) {
            return null;
        }

        $relative = substr($realFile, strlen($realPublic) + 1);

        return str_replace('\\', '/', $relative);
    }

    /**
     * Restrict jQuery to a file under EXT:ns_revolution_slider/Resources/Public/.
     */
    protected function normalizeExtensionPublicRelativeFile(string $path): string
    {
        $path = str_replace('\\', '/', trim($path));
        $path = ltrim($path, '/');
        if ($path === '' || str_contains($path, "\0") || preg_match('#(^|/)\.\.(/|$)#', $path) === 1) {
            return self::DEFAULT_JQUERY_FILE;
        }
        if (!preg_match('#^[A-Za-z0-9._/-]+$#', $path)) {
            return self::DEFAULT_JQUERY_FILE;
        }
        // Keep existing TypoScript that still points at the old filename working.
        if ($path === self::LEGACY_JQUERY_FILE) {
            return self::DEFAULT_JQUERY_FILE;
        }

        return $path;
    }

    /**
     * @param list<string> $allowed
     */
    protected function sanitizeSelect(string $value, array $allowed, string $default): string
    {
        return in_array($value, $allowed, true) ? $value : $default;
    }

    /**
     * Navigation skin names become CSS filenames; allow only a safe token.
     */
    protected function sanitizeNavStyle(string $value): string
    {
        $value = trim($value);
        if ($value === '' || preg_match('/^[A-Za-z0-9_-]+$/', $value) !== 1) {
            return '';
        }

        return $value;
    }

    protected function sanitizeInteger(mixed $value): ?int
    {
        if (is_int($value)) {
            return $value;
        }
        if (is_string($value)) {
            $value = trim($value);
            if ($value !== '' && preg_match('/^-?\d+$/', $value) === 1) {
                return (int)$value;
            }
        }
        if (is_float($value) && floor($value) === $value) {
            return (int)$value;
        }

        return null;
    }

    /**
     * @return list<int>
     */
    protected function sanitizeIntegerList(mixed $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }
        $parts = preg_split('/\s*,\s*/', trim((string)$value)) ?: [];
        $integers = [];
        foreach ($parts as $part) {
            if ($part === '') {
                continue;
            }
            $integer = $this->sanitizeInteger($part);
            if ($integer !== null) {
                $integers[] = $integer;
            }
        }

        return $integers;
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
        $customSettings = [
            'sliderLayout' => ['outerWrapClass' => '', 'innerWrapClass' => ''],
            'arrowsStyle' => ['tmp' => ''],
            'bulletsStyle' => ['tmp' => ''],
        ];
        switch ($settings['sliderLayout'] ?? '') {
            case 'fullwidth':
                $customSettings['sliderLayout']['outerWrapClass'] = 'fullwidthbanner-container';
                $customSettings['sliderLayout']['innerWrapClass'] = 'fullwidthabanner';
                break;
            case 'fullscreen':
                $customSettings['sliderLayout']['outerWrapClass'] = 'fullwidthbanner-container';
                $customSettings['sliderLayout']['innerWrapClass'] = 'fullscreenbanner';
                break;
            default:
                $customSettings['sliderLayout']['outerWrapClass'] = '';
                $customSettings['sliderLayout']['innerWrapClass'] = '';
                break;
        }
        switch ($settings['arrowsStyle'] ?? '') {
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
        switch ($settings['bulletsStyle'] ?? '') {
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
        return $customSettings;
    }
}
