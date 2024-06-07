<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        $typo3VersionArray = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray(
            \TYPO3\CMS\Core\Utility\VersionNumberUtility::getCurrentTypo3Version()
        );

        if (version_compare($typo3VersionArray['version_main'], '10', '>=')) {
            $controller = \NITSAN\NsRevolutionSlider\Controller\SliderController::class;
        } else {
            $controller = 'Slider';
        }
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'NITSAN.NsRevolutionSlider',
            'Slider',
            [
                $controller => 'slider'
            ],
            // non-cacheable actions
            [
                $controller => 'slider'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:ns_revolution_slider/Configuration/TSConfig/ContentElementWizard.tsconfig">'
        );
        
        
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'ns_revolution_slider-plugin-slider',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_revolution_slider/Resources/Public/Icons/Extension.svg']
        );
    }
);
