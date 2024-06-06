<?php

$coreLanguageFile = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:';
$localLanguageFile = 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem',
        'label' => 'headline',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'sortby' => 'sorting',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
        'searchFields' => 'slide_effect,data_duration,headline,headline_animation,description,description_animation,button_text,button_link,button_animation',
        'iconfile' => 'EXT:ns_revolution_slider/Resources/Public/Icons/tx_nsrevolutionslider_domain_model_slideitem.png',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_diffsource, hidden, slide_effect, data_duration, image, headline, headline_animation, description, description_animation, button_text, button_link, button_animation, box_check, box_animation, box_width, box_height, box_bg_color, box_text_color, box_bg_trans_opacity, box_position_x, box_position_y, headline_position_x, headline_position_y, description_position_x, description_position_y, button_position_x, button_position_y, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => $coreLanguageFile . 'LGL.language',
            'config' => [
                'type' => 'language',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => $coreLanguageFile . 'LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slider.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                        'invertStateDisplay' => true,
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => true,
            'label' => $coreLanguageFile . 'LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'datetime',
                'eval' => 'datetime',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => $coreLanguageFile . 'LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'datetime',
                'eval' => 'datetime',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038),
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
            ],
        ],

        'slide_effect' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.slide_effect',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                       'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.globalSetting',
                       'value' => '',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fade',
                        'value' =>'fade',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideup',
                        'value' => 'slideup',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideright',
                        'value' => 'slideright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideleft',
                        'value' => 'slideleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideoverup',
                        'value' => 'slideoverup',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideoverdown',
                        'value' =>  'slideoverdown',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideoverright',
                        'value' =>  'slideoverright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideoverleft',
                        'value' =>  'slideoverleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideremoveup',
                        'value' =>  'slideremoveup',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideremovedown',
                        'value' =>  'slideremovedown',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideremoveright',
                        'value' =>  'slideremoveright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slideremoveleft',
                        'value' =>  'slideremoveleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.boxslide',
                        'value' =>  'boxslide',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slotslide-horizontal',
                        'value' =>  'slotslide-horizontal',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slotslide-vertical',
                        'value' =>  'slotslide-vertical',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.boxfade',
                        'value' => 'boxfade',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slotfade-horizontal',
                        'value' => 'slotfade-horizontal',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slotfade-vertical',
                        'value' => 'slotfade-vertical',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadefromright',
                        'value' => 'fadefromright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadefromleft',
                        'value' => 'fadefromleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadefromtop',
                        'value' => 'fadefromtop',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadefrombottom',
                        'value' => 'fadefrombottom',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadetoleftfadefromright',
                        'value' => 'fadetoleftfadefromright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadetorightfadefromleft',
                        'value' => 'fadetorightfadefromleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadetotopfadefrombottom',
                        'value' => 'fadetotopfadefrombottom',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fadetobottomfadefromtop',
                        'value' => 'fadetobottomfadefromtop',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.parallaxtoright',
                        'value' => 'parallaxtoright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.parallaxtoleft',
                        'value' => 'parallaxtoleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.parallaxtotop',
                        'value' => 'parallaxtotop',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.parallaxtobottom',
                        'value' => 'parallaxtobottom',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.scaledownfromright',
                        'value' => 'scaledownfromright',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.scaledownfromleft',
                        'value' => 'scaledownfromleft',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.scaledownfromtop',
                        'value' => 'scaledownfromtop',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.scaledownfrombottom',
                        'value' => 'scaledownfrombottom',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.curtain-1',
                        'value' => 'curtain-1',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.curtain-2',
                        'value' => 'curtain-2',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.curtain-3',
                        'value' => 'curtain-3',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.3dcurtain-horizontal',
                        'value' => '3dcurtain-horizontal',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.3dcurtain-vertical',
                        'value' => '3dcurtain-vertical',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.cube',
                        'value' => 'cube',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.cube-horizontal',
                        'value' => 'cube-horizontal',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.incube',
                        'value' => 'incube',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.incube-horizontal',
                        'value' => 'incube-horizontal',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.turnoff',
                        'value' => 'turnoff',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.turnoff-vertical',
                        'value' => 'turnoff-vertical',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.papercut',
                        'value' => 'papercut',
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.flyin',
                        'value' => 'flyin',
                    ],
                ],
                'default' => '',
            ],
        ],
        'data_duration' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.data_duration',
            'config' => [
                'type' => 'number',
                'size' => 15,
                'range' => [
                    'lower' => 0,
                    'upper' => 10000,
                ],
            ],
        ],
        'image' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.image',
            'config' => [
                'type' => 'file',
                'maxitems' => 1,
                'allowed' => 'common-image-types',
            ],
        ],
        'headline' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.headline',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'headline_animation' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.headline_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.globalSetting',
                        'value' => 0,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fade',
                        'value' => 1,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromtop',
                        'value' => 2,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfrombottom',
                        'value' => 3,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromleft',
                        'value' => 4,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromright',
                        'value' => 5,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromright',
                        'value' => 6,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromleft',
                        'value' => 7,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromtop',
                        'value' => 8,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfrombottom',
                        'value' => 9,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongleft',
                        'value' => 10,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongright',
                        'value' => 11,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortleft',
                        'value' => 12,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortright',
                        'value' => 13,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.randomrotatescale',
                        'value' => 14,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfrombottom',
                        'value' => 15,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromleft',
                        'value' => 16,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromright',
                        'value' => 17,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromtop',
                        'value' => 18,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.maskedzoomout',
                        'value' => 19,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.popupsmooth',
                        'value' => 20,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfrombottom',
                        'value' => 21,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfromzero',
                        'value' => 22,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfrombottom',
                        'value' => 23,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromleft',
                        'value' => 24,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromright',
                        'value' => 25,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromtop',
                        'value' => 26,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopupone',
                        'value' => 27,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopuptwo',
                        'value' => 28,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromright',
                        'value' => 29,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromleft',
                        'value' => 30,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothslidefrombottom',
                        'value' => 31,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.noanimation',
                        'value' => 32,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.description',
            'config' => [
                'type' => 'text',
                'cols' => 30,
                'rows' => 3,
                'eval' => 'trim',
            ],

        ],
        'description_animation' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.description_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.globalSetting',
                        'value' => 0,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fade',
                        'value' => 1,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromtop',
                        'value' => 2,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfrombottom',
                        'value' => 3,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromleft',
                        'value' => 4,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromright',
                        'value' => 5,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromright',
                        'value' => 6,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromleft',
                        'value' => 7,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromtop',
                        'value' => 8,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfrombottom',
                        'value' => 9,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongleft',
                        'value' =>  10,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongright',
                        'value' =>  11,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortleft',
                        'value' =>  12,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortright',
                        'value' =>  13,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.randomrotatescale',
                        'value' =>  14,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfrombottom',
                        'value' =>  15,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromleft',
                        'value' =>  16,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromright',
                        'value' =>  17,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromtop',
                        'value' =>  18,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.maskedzoomout',
                        'value' =>  19,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.popupsmooth',
                        'value' =>  20,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfrombottom',
                        'value' =>  21,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfromzero',
                        'value' =>  22,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfrombottom',
                        'value' =>  23,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromleft',
                        'value' =>  24,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromright',
                        'value' =>  25,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromtop',
                        'value' =>  26,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopupone',
                        'value' =>  27,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopuptwo',
                        'value' =>  28,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromright',
                        'value' =>  29,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromleft',
                        'value' =>  30,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothslidefrombottom',
                        'value' =>  31,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.noanimation',
                        'value' =>  32,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'button_text' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.button_text',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'button_link' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.button_link',
            'config' => [
                'type' => 'link',
                'size' => 30,
            ],
        ],
        'button_animation' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.button_animation',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.globalSetting',
                        'value' => 0,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fade',
                        'value' => 1,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromtop',
                        'value' => 2,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfrombottom',
                        'value' => 3,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromleft',
                        'value' => 4,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromright',
                        'value' => 5,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromright',
                        'value' => 6,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromleft',
                        'value' => 7,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromtop',
                        'value' => 8,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfrombottom',
                        'value' => 9,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongleft',
                        'value' => 10,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongright',
                        'value' => 11,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortleft',
                        'value' => 12,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortright',
                        'value' => 13,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.randomrotatescale',
                        'value' => 14,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfrombottom',
                        'value' => 15,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromleft',
                        'value' => 16,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromright',
                        'value' => 17,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromtop',
                        'value' => 18,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.maskedzoomout',
                        'value' => 19,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.popupsmooth',
                        'value' => 20,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfrombottom',
                        'value' => 21,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfromzero',
                        'value' => 22,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfrombottom',
                        'value' => 23,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromleft',
                        'value' => 24,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromright',
                        'value' => 25,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromtop',
                        'value' => 26,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopupone',
                        'value' => 27,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopuptwo',
                        'value' => 28,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromright',
                        'value' => 29,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromleft',
                        'value' => 30,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothslidefrombottom',
                        'value' => 31,
                    ],
                    [
                        'label' =>$localLanguageFile . 'tx_ns_revolution_slider_slider.animation.noanimation',
                        'value' => 32,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'box_check' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_check',
            'onChange' => 'reload',
            'config' => [
                'renderType' => 'checkboxToggle',
                'type' => 'check',
            ],
        ],

        'box_animation' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_animation',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.globalSetting',
                        'value' => 0,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.fade',
                        'value' => 1,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromtop',
                        'value' => 2,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfrombottom',
                        'value' => 3,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromleft',
                        'value' => 4,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.sortfromright',
                        'value' => 5,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromright',
                        'value' => 6,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromleft',
                        'value' => 7,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfromtop',
                        'value' => 8,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.longfrombottom',
                        'value' => 9,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongleft',
                        'value' =>  10,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromlongright',
                        'value' =>  11,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortleft',
                        'value' =>  12,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.skewfromshortright',
                        'value' =>  13,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.randomrotatescale',
                        'value' =>  14,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfrombottom',
                        'value' =>  15,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromleft',
                        'value' =>  16,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromright',
                        'value' =>  17,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.letterflyinfromtop',
                        'value' =>  18,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.maskedzoomout',
                        'value' =>  19,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.popupsmooth',
                        'value' =>  20,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfrombottom',
                        'value' =>  21,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.rotateinfromzero',
                        'value' =>  22,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfrombottom',
                        'value' =>  23,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromleft',
                        'value' =>  24,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromright',
                        'value' =>  25,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.slidemaskfromtop',
                        'value' =>  26,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopupone',
                        'value' =>  27,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothpopuptwo',
                        'value' =>  28,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromright',
                        'value' =>  29,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothmaskfromleft',
                        'value' =>  30,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.smoothslidefrombottom',
                        'value' =>  31,
                    ],
                    [
                        'label' => $localLanguageFile . 'tx_ns_revolution_slider_slider.animation.noanimation',
                        'value' =>  32,
                    ],
                ],
                'default' => 0,
            ],
        ],
        'box_bg_color' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_bg_color',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'renderType' => 'color',
                'size' => 30,
            ],
        ],
        'box_text_color' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_font_color',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'renderType' => 'color',
                'size' => 30,
            ],
        ],
        'box_bg_trans_opacity' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_bg_trans_opacity',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'number',
                'size' => 30,
                'format' => 'decimal',
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
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_width',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
                'required' => true,
            ],
        ],
        'box_height' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_height',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
                'required' => true,
            ],
        ],
        'box_position_x' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
                'required' => true,
            ],
        ],
        'box_position_y' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.box_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
                'required' => true,
            ],
        ],
        'headline_position_x' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.headline_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],
        'headline_position_y' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.headline_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],
        'description_position_x' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.description_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],
        'description_position_y' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.description_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],
        'button_position_x' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.button_position_x',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],
        'button_position_y' => [
            'exclude' => true,
            'label' => $localLanguageFile . 'tx_nsrevolutionslider_domain_model_slideitem.button_position_y',
            'displayCond' => 'FIELD:box_check:=:1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,number',
            ],
        ],

    ],
];
