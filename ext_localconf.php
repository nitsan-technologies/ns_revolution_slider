<?php

defined('TYPO3') || die('Access denied.');
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$typo3VersionArray = VersionNumberUtility::convertVersionStringToArray(
    VersionNumberUtility::getCurrentTypo3Version()
);
    // @extensionScannerIgnoreLine
ExtensionUtility::configurePlugin(
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



