<?php

defined('TYPO3') || die('Access denied.');


$typo3VersionArray = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray(
    \TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version()
);

if (version_compare($typo3VersionArray['version_main'], '13', '<=')) {
    // @extensionScannerIgnoreLine
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        $moduleName,
        'Instagramfeeds',
        [
            $moduleClass => 'getfeeeds',
        ],
        // non-cacheable actions
        [
            $moduleClass => ''
        ]
    );

    $icons = [
        'ns_revolution_slider-plugin-slider' => 'user_plugin_slider.svg',
    ];
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    foreach ($icons as $identifier => $path) {
        $iconRegistry->registerIcon(
            $identifier,
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_revolution_slider/Resources/Public/Icons/' . $path]
        );
    }
    // @extensionScannerIgnoreLine
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:ns_revolution_slider/Configuration/TSconfig/ContentElementWizard.tsconfig"'
    );

} else{
    // @extensionScannerIgnoreLine
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'NsRevolutionSlider',
        'Slider',
        [
            \NITSAN\NsRevolutionSlider\Controller\SliderController::class => 'slider'
        ],
        // non-cacheable actions
        [
            \NITSAN\NsRevolutionSlider\Controller\SliderController::class => 'slider'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
}


