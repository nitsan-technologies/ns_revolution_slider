<?php

defined('TYPO3') or die();

$_EXTKEY = 'ns_revolution_slider';

/***************
 * Plugin
 */
$nsRevolutionSlider = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'NsRevolutionSlider',
    'Slider',
    'NS Slider Revolution'
);

/* Flexform setting  */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$nsRevolutionSlider] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$nsRevolutionSlider] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($nsRevolutionSlider, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/FlexForm.xml');
