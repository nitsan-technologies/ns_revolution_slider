<?php

defined('TYPO3') or die();

$_EXTKEY = 'ns_revolution_slider';
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
/***************
 * Plugin
 */
$nsRevolutionSlider = ExtensionUtility::registerPlugin(
    'NsRevolutionSlider',
    'Slider',
    'Slider Revolution',
    'ns_revolution_slider-plugin-slider'
);
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['list_nsrevolutionslider_slider'] = 'ns_revolution_slider-plugin-slider';
ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    '--div--;plugin,pi_flexform,',
    $nsRevolutionSlider,
    'after:subheader',
);
ExtensionManagementUtility::addPiFlexFormValue(
    $nsRevolutionSlider,
    'FILE:EXT:ns_revolution_slider/Configuration/FlexForm/FlexForm.xml',
    'list'
);


$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$nsRevolutionSlider] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$nsRevolutionSlider] = 'pi_flexform';



