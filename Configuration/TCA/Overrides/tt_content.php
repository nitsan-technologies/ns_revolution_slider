<?php

defined('TYPO3') or die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
$_EXTKEY = 'ns_revolution_slider';


/***************
 * Plugin
 */
$nsRevolutionSlider = ExtensionUtility::registerPlugin(
    'NsRevolutionSlider',
    'Slider',
    'Slider Revolution',
    'ns_revolution_slider-plugin-slider'
);

/* Flexform setting  */

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;Configuration,pi_flexform,',
    $nsRevolutionSlider,
    'after:subheader',
);

ExtensionManagementUtility::addPiFlexFormValue(
    '*',
    'FILE:EXT:ns_revolution_slider/Configuration/FlexForm/FlexForm.xml',
    $nsRevolutionSlider,
);
