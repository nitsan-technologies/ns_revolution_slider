<?php

use TYPO3\CMS\Core\Utility\VersionNumberUtility;

$typo3VersionArray = VersionNumberUtility::convertVersionStringToArray(
    VersionNumberUtility::getCurrentTypo3Version()
);
if (version_compare($typo3VersionArray['version_main'], '9.0', '<')) {
    $langfile = 'LLL:EXT:lang/locallang_general.xlf:';
} else {
    $langfile = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:';
}
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slider',
        'label' => 'slider_name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
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
        'searchFields' => '',
        'iconfile' => 'EXT:ns_revolution_slider/Resources/Public/Icons/tx_nsrevolutionslider_domain_model_slider.svg'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slider_name, slides',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, slider_name, slides, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, starttime, endtime'],
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
                'foreign_table' => 'tx_nsrevolutionslider_domain_model_slider',
                'foreign_table_where' => 'AND {#tx_nsrevolutionslider_domain_model_slider}.{#pid}=###CURRENT_PID### AND {#tx_nsrevolutionslider_domain_model_slider}.{#sys_language_uid} IN (-1,0)',
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
        'slider_name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slider.slider_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'slides' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ns_revolution_slider/Resources/Private/Language/locallang_db.xlf:tx_nsrevolutionslider_domain_model_slider.slides',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_nsrevolutionslider_domain_model_slideitem',
                'MM' => 'tx_nsrevolutionslider_slider_slideitem_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],

        ],

    ],
];
