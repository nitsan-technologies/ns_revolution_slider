<?php

declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\EventListener;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;

final class FlexformProcess
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $row = $event->getRecord();
        // $data = $row->getRawRecord();
        if (is_array($row)) {
            // TYPO3 v12 & v13
            $cType = $row['CType'] ?? null;
        } elseif (is_object($row) && method_exists($row, 'getRawRecord')) {
            // TYPO3 v14
            $cType = $row->getRawRecord()->get('CType');
        } else {
            $cType = null;
        }
        if (is_array($row)) {
            $listType = $row['list_type'] ?? '';
            $flexformXml = $row['pi_flexform'] ?? '';
        } elseif (is_object($row) && method_exists($row, 'getRawRecord')) {
            $listType = (string)$row->getRawRecord()->get('list_type');
            $flexformXml = (string)$row->getRawRecord()->get('pi_flexform');
        } else {
            $listType = '';
            $flexformXml = '';
        }
        if ($cType !== 'list' || $listType !== 'nsrevolutionslider_slider') {
            return;
        }

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
            32 => 'backend.animation.noanimation',
        ];
        $itemContent =
            "<table class='table table-condensed table-hover news-table'><thead><tr><th colspan='2'>" . LocalizationUtility::translate('pi1_title', 'ns_revolution_slider') . '</th></tr></thead>';

        $ffXml = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($flexformXml);

        $slidesType = $this->getFlexformValue($ffXml, 'settings.slides_type');
        $slides = $this->getFlexformValue($ffXml, 'settings.slides');
        $slider = $this->getFlexformValue($ffXml, 'settings.slider');
        $slideDuration = $this->getFlexformValue($ffXml, 'settings.slide_duration');
        $slideEffect = $this->getFlexformValue($ffXml, 'settings.slide_effect');

        $itemContent .= '<tbody>';
        if ($slides !== '' && $slidesType === '1') {
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.slides', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . count(explode(',', $slides)) . '</td>
                            </tr>';
        }
        if ($slider !== '' && $slidesType !== '1') {
            $itemContent .= '<tr>
                                <th>' . LocalizationUtility::translate('backend.slider', 'ns_revolution_slider') . "</th>
                                <td style='padding-left: 10px;'>" . $slider . '</td>
                            </tr>';
        }
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.slide_duration', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . ($slideDuration !== '' ? $slideDuration : '-') . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.slide_effect', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . ($slideEffect !== '' ? $slideEffect : LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider')) . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.headline_animation', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformValue($ffXml, 'settings.headline_animation')) . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.description_animation', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformValue($ffXml, 'settings.description_animation')) . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.button_animation', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformValue($ffXml, 'settings.button_animation')) . '</td>
                        </tr>';

        $itemContent .= '</tbody></table>';

        $event->setPreviewContent($itemContent);
    }

    private function getFlexformValue(array $flexform, string $field): string
    {
        return (string)($flexform['data']['sDEF']['lDEF'][$field]['vDEF'] ?? '');
    }

    private function getAnimationLabel(array $animation, string $value): string
    {
        if ($value === '') {
            return (string)LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider');
        }

        $animationKey = is_numeric($value) ? (int)$value : $value;
        if (!isset($animation[$animationKey])) {
            return (string)LocalizationUtility::translate('backend.animation.none', 'ns_revolution_slider');
        }

        return (string)LocalizationUtility::translate($animation[$animationKey], 'ns_revolution_slider');
    }
}
