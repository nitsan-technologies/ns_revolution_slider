<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use NITSAN\NsRevolutionSlider\Controller\SliderController;

ExtensionUtility::configurePlugin(
    'NsRevolutionSlider',
    'Slider',
    [
        SliderController::class => 'slider'
    ],
    // non-cacheable actions
    [
        SliderController::class => 'slider'
    ]
);

