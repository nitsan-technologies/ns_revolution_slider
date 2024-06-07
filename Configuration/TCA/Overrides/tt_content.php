<?php

defined('TYPO3_MODE') or die();

/***************
 * Plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'NITSAN.NsRevolutionSlider',
    'Slider',
    'NS Slider Revolution'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsrevolutionslider_domain_model_slideitem', 'EXT:ns_revolution_slider/Resources/Private/Language/locallang_csh_tx_nsrevolutionslider_domain_model_slideitem.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsrevolutionslider_domain_model_slideitem');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_nsrevolutionslider_domain_model_slider', 'EXT:ns_revolution_slider/Resources/Private/Language/locallang_csh_tx_nsrevolutionslider_domain_model_slider.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_nsrevolutionslider_domain_model_slider');

/* Flexform setting  */
$pluginSignature = str_replace('_', '', 'ns_revolution_slider') . '_' . 'slider';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature, 
    'FILE:EXT:ns_revolution_slider/Configuration/FlexForm/FlexForm.xml'
);
