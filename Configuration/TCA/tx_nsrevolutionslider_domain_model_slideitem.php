<?php
if (version_compare(TYPO3_branch, '9.0', '<')) {
    $langfile = 'LLL:EXT:lang/locallang_general.xlf:';
} else {
    $langfile = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:';
}
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem',
        'label' => 'headline',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'slide_effect,data_duration,headline,description,button_text,button_link',
        'iconfile' => 'EXT:ns_revolution_slider/Resources/Public/Icons/tx_nsrevolutionslider_domain_model_slideitem.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slide_effect, data_duration, image, headline, description, button_text, button_link',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slide_effect, data_duration, image, headline, description, button_text, button_link, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => $langfile . 'LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        $langfile . 'LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => $langfile . 'LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_nsrevolutionslider_domain_model_slideitem',
                'foreign_table_where' => 'AND {#tx_nsrevolutionslider_domain_model_slideitem}.{#pid}=###CURRENT_PID### AND {#tx_nsrevolutionslider_domain_model_slideitem}.{#sys_language_uid} IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => $langfile . 'LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slider.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => $langfile . 'LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => $langfile . 'LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'slide_effect' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.slide_effect',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.globalSetting', ''],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fade', 'fade'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideup', 'slideup'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideright', 'slideright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideleft', 'slideleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideoverup', 'slideoverup'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideoverdown', 'slideoverdown'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideoverright', 'slideoverright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideoverleft', 'slideoverleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideremoveup', 'slideremoveup'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideremovedown', 'slideremovedown'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideremoveright', 'slideremoveright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slideremoveleft', 'slideremoveleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.boxslide', 'boxslide'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slotslide-horizontal', 'slotslide-horizontal'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slotslide-vertical', 'slotslide-vertical'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.boxfade', 'boxfade'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slotfade-horizontal', 'slotfade-horizontal'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slotfade-vertical', 'slotfade-vertical'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadefromright', 'fadefromright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadefromleft', 'fadefromleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadefromtop', 'fadefromtop'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadefrombottom', 'fadefrombottom'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadetoleftfadefromright', 'fadetoleftfadefromright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadetorightfadefromleft', 'fadetorightfadefromleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadetotopfadefrombottom', 'fadetotopfadefrombottom'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fadetobottomfadefromtop', 'fadetobottomfadefromtop'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.parallaxtoright', 'parallaxtoright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.parallaxtoleft', 'parallaxtoleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.parallaxtotop', 'parallaxtotop'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.parallaxtobottom', 'parallaxtobottom'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.scaledownfromright', 'scaledownfromright'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.scaledownfromleft', 'scaledownfromleft'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.scaledownfromtop', 'scaledownfromtop'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.scaledownfrombottom', 'scaledownfrombottom'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.curtain-1', 'curtain-1'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.curtain-2', 'curtain-2'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.curtain-3', 'curtain-3'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.3dcurtain-horizontal', '3dcurtain-horizontal'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.3dcurtain-vertical', '3dcurtain-vertical'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.cube', 'cube'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.cube-horizontal', 'cube-horizontal'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.incube', 'incube'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.incube-horizontal', 'incube-horizontal'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.turnoff', 'turnoff'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.turnoff-vertical', 'turnoff-vertical'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.papercut', 'papercut'],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.flyin', 'flyin']
                ],
                'default' => '',
            ],
        ],
        'data_duration' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.data_duration',
            'config' => [
                'type' => 'input',
                'size' => 15,
                'eval' => 'trim,int',
                'range' => [
                    'lower' => 0,
                    'upper' => 1000000,
                ],
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference'
                    ],
                    'foreign_types' => [
                        '0' => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ],
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                            'showitem' => '
                            --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                            --palette--;;filePalette'
                        ]
                    ],
                    'maxitems' => 1
                ],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'headline' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.headline',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 3,
                'eval' => 'trim',
            ],

        ],
        'button_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.button_text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'button_link' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.button_link',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
    ],
];
