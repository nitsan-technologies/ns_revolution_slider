<?php

defined('TYPO3') or die();

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$flexFormFile = 'FILE:EXT:ns_revolution_slider/Configuration/FlexForm/FlexForm.xml';
$pluginSignature = 'nsrevolutionslider_slider';
$typo3MajorVersion = (new Typo3Version())->getMajorVersion();

if ($typo3MajorVersion < 14) {
    // TYPO3 v12/v13: register as General Plugin (list) + Selected Plugin (list_type).
    // Do NOT use ExtensionUtility::registerPlugin() here: since TYPO3 v13 it registers
    // a dedicated CType, which breaks the General Plugin + Plugin tab UX.
    ExtensionManagementUtility::addPlugin(
        [
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.name',
            'value' => $pluginSignature,
            'icon' => 'ns_revolution_slider-plugin-slider',
            'group' => 'plugins',
            'description' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.description',
        ],
        'list_type',
        'ns_revolution_slider'
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['list_' . $pluginSignature] = 'ns_revolution_slider-plugin-slider';

    ExtensionManagementUtility::addPiFlexFormValue(
        $pluginSignature,
        $flexFormFile,
        'list'
    );

    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
    $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

    // Clean up dedicated CType registration if another extension version registered it before.
    foreach ($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] ?? [] as $index => $item) {
        if ((string)($item['value'] ?? '') === $pluginSignature) {
            unset($GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][$index]);
        }
    }
    unset($GLOBALS['TCA']['tt_content']['types'][$pluginSignature]);
} else {
    // TYPO3 v14: dedicated CType content element (General Plugin / list_type removed in core)
    ExtensionUtility::registerPlugin(
        'NsRevolutionSlider',
        'Slider',
        'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.name',
        'ns_revolution_slider-plugin-slider',
        'plugins',
        'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.description',
        $flexFormFile
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$pluginSignature] = 'ns_revolution_slider-plugin-slider';
}
