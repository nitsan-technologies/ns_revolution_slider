<?php

namespace NITSAN\NsRevolutionSlider\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/***
 *
 * This file is part of the "[NITSAN] Revolution slider" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019
 *
 ***/
/**
 * Slider
 */
class Slider extends AbstractEntity
{
    /**
     * slides
     *
     * @var ?ObjectStorage<SlideItem>
     */
    protected ?ObjectStorage $slides = null;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     */
    protected function initStorageObjects(): void
    {
        $this->slides = new ObjectStorage();
    }

    /**
     * Adds a SlideItem
     *
     * @param SlideItem $slide
     */
    public function addSlide(SlideItem $slide): void
    {
        $this->slides->attach($slide);
    }

    /**
     * Removes a SlideItem
     *
     * @param SlideItem $slideToRemove The SlideItem to be removed
     */
    public function removeSlide(SlideItem $slideToRemove): void
    {
        $this->slides->detach($slideToRemove);
    }

    /**
     * Returns the slides
     *
     * @return ?ObjectStorage<SlideItem> $slides
     */
    public function getSlides(): ?ObjectStorage
    {
        return $this->slides;
    }

    /**
     * Sets the slides
     *
     * @param ObjectStorage<SlideItem> $slides
     */
    public function setSlides(ObjectStorage $slides): void
    {
        $this->slides = $slides;
    }
}
