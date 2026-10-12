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

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeResolver'][1760276100] = [
    'nodeName' => 'tabsContainer',
    'priority' => 40,
    'class' => \NITSAN\NsRevolutionSlider\Form\Resolver\PremiumStripTabsContainerResolver::class,
];
