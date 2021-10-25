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
        'searchFields' => 'slide_effect,data_duration,headline,headline_animation,description,description_animation,button_text,button_link,button_animation',
        'iconfile' => 'EXT:ns_revolution_slider/Resources/Public/Icons/tx_nsrevolutionslider_domain_model_slideitem.png'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slide_effect, data_duration, image, headline, headline_animation, description, description_animation, button_text, button_link, button_animation, box_check, box_animation, box_width, box_height, box_bg_color, box_text_color, box_bg_trans_opacity, box_position_x, box_position_y, headline_position_x, headline_position_y, description_position_x, description_position_y, button_position_x, button_position_y',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slide_effect, data_duration, image, headline, headline_animation, description, description_animation, button_text, button_link, button_animation, box_check, box_animation, box_width, box_height, box_bg_color, box_text_color, box_bg_trans_opacity, box_position_x, box_position_y, headline_position_x, headline_position_y, description_position_x, description_position_y, button_position_x, button_position_y, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
        'headline_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.headline_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.globalSetting', 0],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fade', 1],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromtop', 2],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfrombottom', 3],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromleft', 4],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromright', 5],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromright', 6],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromleft', 7],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromtop', 8],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfrombottom', 9],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongleft', 10],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongright', 11],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortleft', 12],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortright', 13],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.randomrotatescale', 14],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfrombottom', 15],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromleft', 16],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromright', 17],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromtop', 18],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.maskedzoomout', 19],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.popupsmooth', 20],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfrombottom', 21],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfromzero', 22],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfrombottom', 23],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromleft', 24],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromright', 25],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromtop', 26],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopupone', 27],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopuptwo', 28],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromright', 29],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromleft', 30],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothslidefrombottom', 31],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.noanimation', 32]
                ],
                'default' => 0,
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
        'description_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.description_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.globalSetting', 0],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fade', 1],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromtop', 2],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfrombottom', 3],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromleft', 4],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromright', 5],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromright', 6],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromleft', 7],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromtop', 8],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfrombottom', 9],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongleft', 10],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongright', 11],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortleft', 12],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortright', 13],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.randomrotatescale', 14],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfrombottom', 15],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromleft', 16],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromright', 17],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromtop', 18],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.maskedzoomout', 19],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.popupsmooth', 20],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfrombottom', 21],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfromzero', 22],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfrombottom', 23],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromleft', 24],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromright', 25],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromtop', 26],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopupone', 27],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopuptwo', 28],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromright', 29],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromleft', 30],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothslidefrombottom', 31],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.noanimation', 32]
                ],
                'default' => 0,
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
        'button_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.button_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.globalSetting', 0],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fade', 1],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromtop', 2],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfrombottom', 3],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromleft', 4],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromright', 5],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromright', 6],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromleft', 7],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromtop', 8],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfrombottom', 9],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongleft', 10],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongright', 11],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortleft', 12],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortright', 13],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.randomrotatescale', 14],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfrombottom', 15],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromleft', 16],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromright', 17],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromtop', 18],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.maskedzoomout', 19],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.popupsmooth', 20],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfrombottom', 21],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfromzero', 22],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfrombottom', 23],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromleft', 24],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromright', 25],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromtop', 26],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopupone', 27],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopuptwo', 28],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromright', 29],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromleft', 30],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothslidefrombottom', 31],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.noanimation', 32]
                ],
                'default' => 0,
            ],
        ],
        'box_check' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_check',
            'onChange' => 'reload',
            'config' => [
                'type' => 'check',
            ],
        ],

        'box_animation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_animation',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.globalSetting', 0],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.fade', 1],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromtop', 2],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfrombottom', 3],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromleft', 4],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.sortfromright', 5],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromright', 6],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromleft', 7],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfromtop', 8],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.longfrombottom', 9],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongleft', 10],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromlongright', 11],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortleft', 12],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.skewfromshortright', 13],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.randomrotatescale', 14],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfrombottom', 15],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromleft', 16],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromright', 17],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.letterflyinfromtop', 18],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.maskedzoomout', 19],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.popupsmooth', 20],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfrombottom', 21],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.rotateinfromzero', 22],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfrombottom', 23],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromleft', 24],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromright', 25],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.slidemaskfromtop', 26],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopupone', 27],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothpopuptwo', 28],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromright', 29],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothmaskfromleft', 30],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.smoothslidefrombottom', 31],
                    ['LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_ns_revolution_slider_slider.animation.noanimation', 32]
                ],
                'default' => 0,
            ],
        ],
        'box_bg_color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_bg_color',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'box_text_color' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_font_color',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'renderType' => 'colorpicker',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'box_bg_trans_opacity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_bg_trans_opacity',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,float',
                'range' => [
                    'lower' => 0,
                    'upper' => 1,
                ],
                'default' => 0,
                'slider' => [
                    'step' => 0.1,
                    'width' => 200,
                ],
            ],
        ],
        'box_width' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_width',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number,required'
            ],
        ],
        'box_height' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_height',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number,required'
            ],
        ],
        'box_position_x' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number,required'
            ],
        ],
        'box_position_y' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.box_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number,required'
            ],
        ],
        'headline_position_x' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.headline_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],
        'headline_position_y' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.headline_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],
        'description_position_x' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.description_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],
        'description_position_y' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.description_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],
        'button_position_x' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.button_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],
        'button_position_y' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slideitem.button_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number'
            ],
        ],

    ],
];
