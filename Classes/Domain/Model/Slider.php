<?php
namespace NITSAN\NsRevolutionSlider\Domain\Model;

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
class Slider extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * slides
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsRevolutionSlider\Domain\Model\SlideItem>
     */
    protected $slides = null;

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
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->slides = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a SlideItem
     *
     * @param \NITSAN\NsRevolutionSlider\Domain\Model\SlideItem $slide
     * @return void
     */
    public function addSlide(\NITSAN\NsRevolutionSlider\Domain\Model\SlideItem $slide)
    {
        $this->slides->attach($slide);
    }

    /**
     * Removes a SlideItem
     *
     * @param \NITSAN\NsRevolutionSlider\Domain\Model\SlideItem $slideToRemove The SlideItem to be removed
     * @return void
     */
    public function removeSlide(\NITSAN\NsRevolutionSlider\Domain\Model\SlideItem $slideToRemove)
    {
        $this->slides->detach($slideToRemove);
    }

    /**
     * Returns the slides
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsRevolutionSlider\Domain\Model\SlideItem> $slides
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * Sets the slides
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\NITSAN\NsRevolutionSlider\Domain\Model\SlideItem> $slides
     * @return void
     */
    public function setSlides(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $slides)
    {
        $this->slides = $slides;
    }
}
