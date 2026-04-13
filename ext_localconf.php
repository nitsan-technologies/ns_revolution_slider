<?php

defined('TYPO3') || die('Access denied.');


$typo3VersionArray = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray(
    \TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version()
);
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
);
if (version_compare($typo3VersionArray['version_main'], '13', '<=')) {
    
    // @extensionScannerIgnoreLine
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:ns_revolution_slider/Configuration/TSconfig/ContentElementWizard.tsconfig"'
    );
} 


