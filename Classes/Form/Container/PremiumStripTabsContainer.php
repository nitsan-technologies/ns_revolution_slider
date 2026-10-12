<?php

declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\Form\Container;

use NITSAN\NsRevolutionSlider\Backend\PremiumStrip;
use TYPO3\CMS\Backend\Form\Container\TabsContainer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Core tabs container with the premium strip above the tab menu of the Slider Revolution content element.
 */
final class PremiumStripTabsContainer extends TabsContainer
{
    public function render(): array
    {
        $resultArray = parent::render();

        $strip = GeneralUtility::makeInstance(PremiumStrip::class)->render();
        if ($strip !== '') {
            $resultArray['html'] = $strip . $resultArray['html'];
            $resultArray['stylesheetFiles'][] = PremiumStrip::STYLESHEET;
        }

        return $resultArray;
    }
}
