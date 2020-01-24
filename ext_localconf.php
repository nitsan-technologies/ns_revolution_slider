<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'NITSAN.NsRevolutionSlider',
            'Slider',
            [
                'Slider' => 'slider'
            ],
            // non-cacheable actions
            [
                'Slider' => 'slider'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    slider {
                        iconIdentifier = ns_revolution_slider-plugin-slider
                        title = LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.name
                        description = LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.description
                        tt_content_defValues {
                            CType = list
                            list_type = nsrevolutionslider_slider
                        }
                    }
                }
                show = *
            }
       }'
        );
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'ns_revolution_slider-plugin-slider',
            \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            ['source' => 'EXT:ns_revolution_slider/Resources/Public/Icons/user_plugin_slider.svg']
        );
    }
);
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['ns_revolution_slider']
        = \NITSAN\NsRevolutionSlider\Hooks\PageLayoutView::class;
