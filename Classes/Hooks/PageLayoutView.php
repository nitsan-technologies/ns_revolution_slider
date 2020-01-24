<?php
namespace Nitsan\NsRevolutionSlider\Hooks;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class PageLayoutView implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface
{
    public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row)
    {
        if ($row['CType'] == 'list' && $row['list_type'] == 'nsrevolutionslider_slider') {
            $drawItem = false;
            $animation = [
                0 => 'backend.globalSetting',
                1 => 'backend.animation.fade',
                2 => 'backend.animation.sortfromtop',
                3 => 'backend.animation.sortfrombottom',
                4 => 'backend.animation.sortfromleft',
                5 => 'backend.animation.sortfromright',
                6 => 'backend.animation.longfromright',
                7 => 'backend.animation.longfromleft',
                8 => 'backend.animation.longfromtop',
                9 => 'backend.animation.longfrombottom',
                10 => 'backend.animation.skewfromlongleft',
                11 => 'backend.animation.skewfromlongright',
                12 => 'backend.animation.skewfromshortleft',
                13 => 'backend.animation.skewfromshortright',
                14 => 'backend.animation.randomrotatescale',
                15 => 'backend.animation.letterflyinfrombottom',
                16 => 'backend.animation.letterflyinfromleft',
                17 => 'backend.animation.letterflyinfromright',
                18 => 'backend.animation.letterflyinfromtop',
                19 => 'backend.animation.maskedzoomout',
                20 => 'backend.animation.popupsmooth',
                21 => 'backend.animation.rotateinfrombottom',
                22 => 'backend.animation.rotateinfromzero',
                23 => 'backend.animation.slidemaskfrombottom',
                24 => 'backend.animation.slidemaskfromleft',
                25 => 'backend.animation.slidemaskfromright',
                26 => 'backend.animation.slidemaskfromtop',
                27 => 'backend.animation.smoothpopupone',
                28 => 'backend.animation.smoothpopuptwo',
                29 => 'backend.animation.smoothmaskfromright',
                30 => 'backend.animation.smoothmaskfromleft',
                31 => 'backend.animation.smoothslidefrombottom',
                32 => 'backend.animation.noanimation'
            ];
            $headerContent =
                "<table class='table table-condensed table-hover news-table'><thead><tr><th colspan='2'>" . LocalizationUtility::translate('pi1_title', 'ns_revolution_slider') . '</th></tr></thead>';

            $ffXml = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($row['pi_flexform']);

            $itemContent= '<tbody>';

            if ($ffXml['data']['sDEF']['lDEF']['settings.slides']['vDEF'] != '' && $ffXml['data']['sDEF']['lDEF']['settings.slides_type']['vDEF'] == 0) {
                $itemContent .= '<tr>
                                    <th>' . LocalizationUtility::translate('backend.slides', 'ns_revolution_slider') . "</th>
                                    <td style='padding-left: 10px;'>" . count(explode(',', $ffXml['data']['sDEF']['lDEF']['settings.slides']['vDEF'])) . '</td>
                                </tr>';
            }
            if ($ffXml['data']['sDEF']['lDEF']['settings.slider']['vDEF'] != '' && $ffXml['data']['sDEF']['lDEF']['settings.slides_type']['vDEF'] == 1) {
                $itemContent .= '<tr>
                                    <th>' . LocalizationUtility::translate('backend.slider', 'ns_revolution_slider') . "</th>
                                    <td style='padding-left: 10px;'>" . $ffXml['data']['sDEF']['lDEF']['settings.slider']['vDEF'] . '</td>
                                </tr>';
            }
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.slide_duration', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . ($ffXml['data']['sDEF']['lDEF']['settings.slide_duration']['vDEF'] != '' ? $ffXml['data']['sDEF']['lDEF']['settings.slide_duration']['vDEF'] : '-') . '</td>
                            </tr>';
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.slide_effect', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . ($ffXml['data']['sDEF']['lDEF']['settings.slide_effect']['vDEF'] != '' ? $ffXml['data']['sDEF']['lDEF']['settings.slide_effect']['vDEF'] :  LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider')) . '</td>
                            </tr>';
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.headline_animation', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . ($ffXml['data']['sDEF']['lDEF']['settings.headline_animation']['vDEF'] != '' ? LocalizationUtility::translate($animation[$ffXml['data']['sDEF']['lDEF']['settings.headline_animation']['vDEF']], 'ns_revolution_slider') : LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider')) . '</td>
                            </tr>';
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.description_animation', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . ($ffXml['data']['sDEF']['lDEF']['settings.description_animation']['vDEF'] != '' ?  LocalizationUtility::translate($animation[$ffXml['data']['sDEF']['lDEF']['settings.description_animation']['vDEF']], 'ns_revolution_slider') : LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider')) . '</td>
                            </tr>';

            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.button_animation', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . ($ffXml['data']['sDEF']['lDEF']['settings.button_animation']['vDEF'] != '' ? LocalizationUtility::translate($animation[$ffXml['data']['sDEF']['lDEF']['settings.button_animation']['vDEF']], 'ns_revolution_slider') :  LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider')) . '</td>
                            </tr>';

            $itemContent .= '</tbody></table>';
        }
    }
}
