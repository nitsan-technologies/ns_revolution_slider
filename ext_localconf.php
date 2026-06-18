<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// @extensionScannerIgnoreLine
ExtensionUtility::configurePlugin(
    'NsRevolutionSlider',
    'Slider',
    [
        \NITSAN\NsRevolutionSlider\Controller\SliderController::class => 'slider',
    ],
    [
        \NITSAN\NsRevolutionSlider\Controller\SliderController::class => 'slider',
    ],
);
