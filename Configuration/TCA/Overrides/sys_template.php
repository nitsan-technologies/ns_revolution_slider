<?php

defined('TYPO3') || die('Access denied.');

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Adding fields to the tt_content table definition in TCA
ExtensionManagementUtility::addStaticFile(
    'ns_revolution_slider',
    'Configuration/TypoScript',
    'Slider Revolution'
);
