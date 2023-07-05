<?php

defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '@import \'EXT:ns_revolution_slider/Configuration/TSconfig/ContentElementWizard.tsconfig\''
);
