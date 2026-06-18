<?php

declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\EventListener;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

final class FlexformProcess
{
    private const PLUGIN_SIGNATURE = 'nsrevolutionslider_slider';

    /**
     * Legacy CType used by an earlier migration wizard version.
     */
    private const LEGACY_MIGRATED_CTYPE = 'slider';

    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        if ($event->getTable() !== 'tt_content' || !$this->isRevolutionSliderRecord($event)) {
            return;
        }

        $record = $event->getRecord();

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

        $slidesType = $this->getFlexformSetting($record, 'settings.slides_type');
        $slides = $this->getFlexformSetting($record, 'settings.slides');
        $slider = $this->getFlexformSetting($record, 'settings.slider');
        $slideDuration = $this->getFlexformSetting($record, 'settings.slide_duration');
        $slideEffect = $this->getFlexformSetting($record, 'settings.slide_effect');

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
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformSetting($record, 'settings.headline_animation')) . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.description_animation', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformSetting($record, 'settings.description_animation')) . '</td>
                        </tr>';
        $itemContent .= '<tr>
                            <th>' . LocalizationUtility::translate('backend.button_animation', 'ns_revolution_slider') . "</th>
                            <td style='padding-left: 10px;'>" . $this->getAnimationLabel($animation, $this->getFlexformSetting($record, 'settings.button_animation')) . '</td>
                        </tr>';

        $itemContent .= '</tbody></table>';

        $event->setPreviewContent($itemContent);
    }

    private function isRevolutionSliderRecord(PageContentPreviewRenderingEvent $event): bool
    {
        $recordType = $event->getRecordType();

        if (in_array($recordType, [self::PLUGIN_SIGNATURE, self::LEGACY_MIGRATED_CTYPE], true)) {
            return true;
        }

        if ($recordType !== 'list') {
            return false;
        }

        return $this->getRecordFieldValue($event->getRecord(), 'list_type') === self::PLUGIN_SIGNATURE;
    }

    /**
     * @param array<string, mixed>|object $record
     */
    private function getRecordFieldValue(array|object $record, string $field): string
    {
        if (is_array($record)) {
            return (string)($record[$field] ?? '');
        }

        if ($record->has($field)) {
            $value = $record->get($field);
            if (is_scalar($value) || $value === null) {
                return (string)($value ?? '');
            }
        }

        $rawRecord = $record->getRawRecord();
        if ($rawRecord !== null && $rawRecord->has($field)) {
            $value = $rawRecord->get($field);
            if (is_scalar($value) || $value === null) {
                return (string)($value ?? '');
            }
        }

        return '';
    }

    /**
     * @param array<string, mixed>|object $record
     */
    private function getFlexformSetting(array|object $record, string $field): string
    {
        if (is_array($record)) {
            $flexformXml = (string)($record['pi_flexform'] ?? '');
            if ($flexformXml === '') {
                return '';
            }

            return $this->getFlexformValueFromXml($flexformXml, $field);
        }

        if ($record->has('pi_flexform')) {
            $flexFormData = $record->get('pi_flexform');
            if ($this->isFlexFormFieldValues($flexFormData)) {
                return $this->getFlexformValueFromFieldValues($flexFormData, $field);
            }
            if (is_string($flexFormData) && $flexFormData !== '') {
                return $this->getFlexformValueFromXml($flexFormData, $field);
            }
        }

        if (method_exists($record, 'getRawRecord')) {
            $rawRecord = $record->getRawRecord();
            if ($rawRecord !== null && $rawRecord->has('pi_flexform')) {
                $flexformXml = (string)$rawRecord->get('pi_flexform');
                if ($flexformXml !== '') {
                    return $this->getFlexformValueFromXml($flexformXml, $field);
                }
            }
        }

        return '';
    }

    private function isFlexFormFieldValues(mixed $value): bool
    {
        return is_object($value)
            && class_exists(\TYPO3\CMS\Core\Domain\FlexFormFieldValues::class)
            && $value instanceof \TYPO3\CMS\Core\Domain\FlexFormFieldValues;
    }

    /**
     * @param \TYPO3\CMS\Core\Domain\FlexFormFieldValues $flexFormData
     */
    private function getFlexformValueFromFieldValues(object $flexFormData, string $field): string
    {
        foreach (['sDEF/' . $field, $field] as $path) {
            try {
                if ($flexFormData->has($path)) {
                    return $this->normalizeFlexformValue($flexFormData->get($path));
                }
            } catch (\Throwable) {
                continue;
            }
        }

        return '';
    }

    private function getFlexformValueFromXml(string $flexformXml, string $field): string
    {
        $flexform = GeneralUtility::xml2array($flexformXml);

        return (string)($flexform['data']['sDEF']['lDEF'][$field]['vDEF'] ?? '');
    }

    private function normalizeFlexformValue(mixed $value): string
    {
        if (is_scalar($value) || $value === null) {
            return (string)($value ?? '');
        }

        if (is_object($value) && method_exists($value, 'getUid')) {
            return (string)$value->getUid();
        }

        return '';
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
