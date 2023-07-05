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
     * boxBgColor
     *
     * @var string
     */
    protected $boxBgColor = '';

    /**
     * boxTextColor
     *
     * @var string
     */
    protected $boxTextColor = '';

    /**
     * boxBgTransOpacity
     *
     * @var string
     */
    protected $boxBgTransOpacity = '';

    /**
     * boxPositionX
     *
     * @var string
     */
    protected $boxPositionX = '';

    /**
     * boxPositionY
     *
     * @var string
     */
    protected $boxPositionY = '';

    /**
     * boxAnimation
     *
     * @var string
     */
    protected $boxAnimation = '';

    /**
     * boxHeight
     *
     * @var string
     */
    protected $boxHeight = '';

    /**
     * headlinePositionX
     *
     * @var string
     */
    protected $headlinePositionX = '';

    /**
     * headlinePositionY
     *
     * @var string
     */
    protected $headlinePositionY = '';

    /**
     * descriptionPositionX
     *
     * @var string
     */
    protected $descriptionPositionX = '';

    /**
     * descriptionPositionY
     *
     * @var string
     */
    protected $descriptionPositionY = '';

    /**
     * buttonPositionX
     *
     * @var string
     */
    protected $buttonPositionX = '';

    /**
     * buttonPositionY
     *
     * @var string
     */
    protected $buttonPositionY = '';

    /**
     * boxWidth
     *
     * @var string
     */
    protected $boxWidth = '';

    /**
     * boxCheck
     *
     * @var string
     */
    protected $boxCheck = '';

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
     * @return string $DataDuration
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

    /**
     * Returns the boxBgColor
     *
     * @return string $boxBgColor
     */
    public function getBoxBgColor()
    {
        return $this->boxBgColor;
    }

    /**
     * Sets the boxBgColor
     *
     * @param string $boxBgColor
     * @return void
     */
    public function setBoxBgColor($boxBgColor)
    {
        $this->boxBgColor = $boxBgColor;
    }

    /**
     * Returns the boxTextColor
     *
     * @return string $boxTextColor
     */
    public function getBoxTextColor()
    {
        return $this->boxTextColor;
    }

    /**
     * Sets the boxTextColor
     *
     * @param string $boxTextColor
     * @return void
     */
    public function setBoxTextColor($boxTextColor)
    {
        $this->boxTextColor = $boxTextColor;
    }

    /**
     * Returns the boxBgTransOpacity
     *
     * @return string $boxBgTransOpacity
     */
    public function getBoxBgTransOpacity()
    {
        return $this->boxBgTransOpacity;
    }

    /**
     * Sets the boxBgTransOpacity
     *
     * @param string $boxBgTransOpacity
     * @return void
     */
    public function setBoxBgTransOpacity($boxBgTransOpacity)
    {
        $this->boxBgTransOpacity = $boxBgTransOpacity;
    }

    /**
     * Returns the boxPositionX
     *
     * @return string $boxPositionX
     */
    public function getBoxPositionX()
    {
        return $this->boxPositionX;
    }

    /**
     * Sets the boxPositionX
     *
     * @param string $boxPositionX
     * @return void
     */
    public function setBoxPositionX($boxPositionX)
    {
        $this->boxPositionX = $boxPositionX;
    }

    /**
     * Returns the boxPositionY
     *
     * @return string $boxPositionY
     */
    public function getBoxPositionY()
    {
        return $this->boxPositionY;
    }

    /**
     * Sets the boxPositionY
     *
     * @param string $boxPositionY
     * @return void
     */
    public function setBoxPositionY($boxPositionY)
    {
        $this->boxPositionY = $boxPositionY;
    }

    /**
    * Returns the boxAnimation
    *
    * @return string $boxAnimation
    */
    public function getBoxAnimation()
    {
        return $this->boxAnimation;
    }

    /**
     * Sets the boxAnimation
     *
     * @param string $boxAnimation
     * @return void
     */
    public function setBoxAnimation($boxAnimation)
    {
        $this->boxAnimation = $boxAnimation;
    }

    /**
     * Returns the boxHeight
     *
     * @return string $boxHeight
     */
    public function getBoxHeight()
    {
        return $this->boxHeight;
    }

    /**
     * Sets the boxHeight
     *
     * @param string $boxHeight
     * @return void
     */
    public function setBoxHeight($boxHeight)
    {
        $this->boxHeight = $boxHeight;
    }

    /**
     * Returns the headlinePositionX
     *
     * @return string $headlinePositionX
     */
    public function getHeadlinePositionX()
    {
        return $this->headlinePositionX;
    }

    /**
     * Sets the headlinePositionX
     *
     * @param string $headlinePositionX
     * @return void
     */
    public function setHeadlinePositionX($headlinePositionX)
    {
        $this->headlinePositionX = $headlinePositionX;
    }

    /**
     * Returns the headlinePositionY
     *
     * @return string $headlinePositionY
     */
    public function getHeadlinePositionY()
    {
        return $this->headlinePositionY;
    }

    /**
     * Sets the headlinePositionY
     *
     * @param string $headlinePositionY
     * @return void
     */
    public function setHeadlinePositionY($headlinePositionY)
    {
        $this->headlinePositionY = $headlinePositionY;
    }

    /**
     * Returns the descriptionPositionX
     *
     * @return string $descriptionPositionX
     */
    public function getDescriptionPositionX()
    {
        return $this->descriptionPositionX;
    }

    /**
     * Sets the descriptionPositionX
     *
     * @param string $descriptionPositionX
     * @return void
     */
    public function setDescriptionPositionX($descriptionPositionX)
    {
        $this->descriptionPositionX = $descriptionPositionX;
    }

    /**
     * Returns the descriptionPositionY
     *
     * @return string $descriptionPositionY
     */
    public function getDescriptionPositionY()
    {
        return $this->descriptionPositionY;
    }

    /**
     * Sets the descriptionPositionY
     *
     * @param string $descriptionPositionY
     * @return void
     */
    public function setDescriptionPositionY($descriptionPositionY)
    {
        $this->descriptionPositionY = $descriptionPositionY;
    }

    /**
     * Returns the buttonPositionX
     *
     * @return string $buttonPositionX
     */
    public function getButtonPositionX()
    {
        return $this->buttonPositionX;
    }

    /**
     * Sets the buttonPositionX
     *
     * @param string $buttonPositionX
     * @return void
     */
    public function setButtonPositionX($buttonPositionX)
    {
        $this->buttonPositionX = $buttonPositionX;
    }

    /**
     * Returns the buttonPositionY
     *
     * @return string $buttonPositionY
     */
    public function getButtonPositionY()
    {
        return $this->buttonPositionY;
    }

    /**
     * Sets the buttonPositionY
     *
     * @param string $buttonPositionY
     * @return void
     */
    public function setButtonPositionY($buttonPositionY)
    {
        $this->buttonPositionY = $buttonPositionY;
    }

    /**
     * Returns the boxWidth
     *
     * @return string $boxWidth
     */
    public function getBoxWidth()
    {
        return $this->boxWidth;
    }

    /**
     * Sets the boxWidth
     *
     * @param string $boxWidth
     * @return void
     */
    public function setBoxWidth($boxWidth)
    {
        $this->boxWidth = $boxWidth;
    }

    /**
     * Returns the boxCheck
     *
     * @return string $boxCheck
     */
    public function getBoxCheck()
    {
        return $this->boxCheck;
    }

    /**
     * Sets the boxCheck
     *
     * @param string $boxCheck
     * @return void
     */
    public function setBoxCheck($boxCheck)
    {
        $this->boxCheck = $boxCheck;
    }
}
