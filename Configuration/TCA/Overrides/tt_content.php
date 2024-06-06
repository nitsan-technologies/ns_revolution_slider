<?php

defined('TYPO3') or die();

/***************
 * Plugin
 */
$pluginSignature = \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'NsRevolutionSlider',
    'Slider',
    'NS Slider Revolution'
);

/* Flexform setting  */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] =
    'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:ns_revolution_slider/Configuration/FlexForm/FlexForm.xml'
);
