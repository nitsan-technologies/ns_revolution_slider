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
