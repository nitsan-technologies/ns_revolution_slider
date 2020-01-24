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
 * SlideItem
 */
class SlideItem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * slideEffect
     *
     * @var string
     */
    protected $slideEffect = '';

    /**
     * dataDuration
     *
     * @var string
     */
    protected $dataDuration = '';

    /**
     * image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected $image = null;

    /**
     * headline
     *
     * @var string
     */
    protected $headline = '';

    /**
     * headlineAnimation
     *
     * @var string
     */
    protected $headlineAnimation = '';

    /**
     * headlineColor
     *
     * @var string
     */
    protected $headlineColor = '';

    /**
     * headlineSize
     *
     * @var string
     */
    protected $headlineSize = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * descriptionAnimation
     *
     * @var string
     */
    protected $descriptionAnimation = '';

    /**
     * descriptionColor
     *
     * @var string
     */
    protected $descriptionColor = '';

    /**
     * descriptionSize
     *
     * @var string
     */
    protected $descriptionSize = '';

    /**
     * buttonText
     *
     * @var string
     */
    protected $buttonText = '';

    /**
     * buttonLink
     *
     * @var string
     */
    protected $buttonLink = '';

    /**
     * buttonAnimation
     *
     * @var string
     */
    protected $buttonAnimation = '';

    /**
     * buttonTextColor
     *
     * @var string
     */
    protected $buttonTextColor = '';

    /**
     * buttonTextSize
     *
     * @var string
     */
    protected $buttonTextSize = '';

    /**
     * Returns the slideEffect
     *
     * @return string $slideEffect
     */
    public function getSlideEffect()
    {
        return $this->slideEffect;
    }

    /**
     * Sets the slideEffect
     *
     * @param string $slideEffect
     * @return void
     */
    public function setSlideEffect($slideEffect)
    {
        $this->slideEffect = $slideEffect;
    }

    /**
     * Returns the dataDuration
     *
     * @return string $dataDuration
     */
    public function getDataDuration()
    {
        return $this->dataDuration;
    }

    /**
     * Sets the dataDuration
     *
     * @param string $dataDuration
     * @return void
     */
    public function setDataDuration($dataDuration)
    {
        $this->dataDuration = $dataDuration;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the headline
     *
     * @return string $headline
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Sets the headline
     *
     * @param string $headline
     * @return void
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * Returns the headlineAnimation
     *
     * @return string $headlineAnimation
     */
    public function getHeadlineAnimation()
    {
        return $this->headlineAnimation;
    }

    /**
     * Sets the headlineAnimation
     *
     * @param string $headlineAnimation
     * @return void
     */
    public function setHeadlineAnimation($headlineAnimation)
    {
        $this->headlineAnimation = $headlineAnimation;
    }

    /**
     * Returns the headlineColor
     *
     * @return string $headlineColor
     */
    public function getHeadlineColor()
    {
        return $this->headlineColor;
    }

    /**
     * Sets the headlineColor
     *
     * @param string $headlineColor
     * @return void
     */
    public function setHeadlineColor($headlineColor)
    {
        $this->headlineColor = $headlineColor;
    }

    /**
     * Returns the headlineSize
     *
     * @return string $headlineSize
     */
    public function getHeadlineSize()
    {
        return $this->headlineSize;
    }

    /**
     * Sets the headlineSize
     *
     * @param string $headlineSize
     * @return void
     */
    public function setHeadlineSize($headlineSize)
    {
        $this->headlineSize = $headlineSize;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the descriptionAnimation
     *
     * @return string $descriptionAnimation
     */
    public function getDescriptionAnimation()
    {
        return $this->descriptionAnimation;
    }

    /**
     * Sets the descriptionAnimation
     *
     * @param string $descriptionAnimation
     * @return void
     */
    public function setDescriptionAnimation($descriptionAnimation)
    {
        $this->descriptionAnimation = $descriptionAnimation;
    }

    /**
     * Returns the descriptionColor
     *
     * @return string $descriptionColor
     */
    public function getDescriptionColor()
    {
        return $this->descriptionColor;
    }

    /**
     * Sets the descriptionColor
     *
     * @param string $descriptionColor
     * @return void
     */
    public function setDescriptionColor($descriptionColor)
    {
        $this->descriptionColor = $descriptionColor;
    }

    /**
     * Returns the descriptionSize
     *
     * @return string $descriptionSize
     */
    public function getDescriptionSize()
    {
        return $this->descriptionSize;
    }

    /**
     * Sets the descriptionSize
     *
     * @param string $descriptionSize
     * @return void
     */
    public function setDescriptionSize($descriptionSize)
    {
        $this->descriptionSize = $descriptionSize;
    }

    /**
     * Returns the buttonText
     *
     * @return string $buttonText
     */
    public function getButtonText()
    {
        return $this->buttonText;
    }

    /**
     * Sets the buttonText
     *
     * @param string $buttonText
     * @return void
     */
    public function setButtonText($buttonText)
    {
        $this->buttonText = $buttonText;
    }

    /**
     * Returns the buttonLink
     *
     * @return string $buttonLink
     */
    public function getButtonLink()
    {
        return $this->buttonLink;
    }

    /**
     * Sets the buttonLink
     *
     * @param string $buttonLink
     * @return void
     */
    public function setButtonLink($buttonLink)
    {
        $this->buttonLink = $buttonLink;
    }

    /**
     * Returns the buttonAnimation
     *
     * @return string $buttonAnimation
     */
    public function getButtonAnimation()
    {
        return $this->buttonAnimation;
    }

    /**
     * Sets the buttonAnimation
     *
     * @param string $buttonAnimation
     * @return void
     */
    public function setButtonAnimation($buttonAnimation)
    {
        $this->buttonAnimation = $buttonAnimation;
    }

    /**
     * Returns the buttonTextColor
     *
     * @return string $buttonTextColor
     */
    public function getButtonTextColor()
    {
        return $this->buttonTextColor;
    }

    /**
     * Sets the buttonTextColor
     *
     * @param string $buttonTextColor
     * @return void
     */
    public function setButtonTextColor($buttonTextColor)
    {
        $this->buttonTextColor = $buttonTextColor;
    }

    /**
     * Returns the buttonTextSize
     *
     * @return string $buttonTextSize
     */
    public function getButtonTextSize()
    {
        return $this->buttonTextSize;
    }

    /**
     * Sets the buttonTextSize
     *
     * @param string $buttonTextSize
     * @return void
     */
    public function setButtonTextSize($buttonTextSize)
    {
        $this->buttonTextSize = $buttonTextSize;
    }
}
