<?php

defined('TYPO3') || die('Access denied.');

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
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants(
    "@import 'EXT:ns_revolution_slider/Configuration/TypoScript/constants.typoscript'"
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
    "@import 'EXT:ns_revolution_slider/Configuration/TypoScript/setup.typoscript'"
);

