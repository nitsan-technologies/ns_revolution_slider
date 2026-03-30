<?php

defined('TYPO3') || die('Access denied.');

// Adding fields to the tt_content table definition in TCA
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'ns_revolution_slider',
    'Configuration/TypoScript',
    'Slider Revolution'
);
