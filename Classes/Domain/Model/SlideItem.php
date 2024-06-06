<?php

namespace NITSAN\NsRevolutionSlider\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
class SlideItem extends AbstractEntity
{
    /**
     * slideEffect
     *
     * @var string
     */
    protected string $slideEffect = '';

    /**
     * dataDuration
     *
     * @var string
     */
    protected string $dataDuration = '';

    /**
     * image
     *
     * @var ?FileReference
     * @TYPO3\CMS\Extbase\Annotation\ORM\Cascade("remove")
     */
    protected ?FileReference $image = null;

    /**
     * headline
     *
     * @var string
     */
    protected string $headline = '';

    /**
     * headlineAnimation
     *
     * @var string
     */
    protected string $headlineAnimation = '';

    /**
     * headlineColor
     *
     * @var string
     */
    protected string $headlineColor = '';

    /**
     * headlineSize
     *
     * @var string
     */
    protected string $headlineSize = '';

    /**
     * description
     *
     * @var string
     */
    protected string $description = '';

    /**
     * descriptionAnimation
     *
     * @var string
     */
    protected string $descriptionAnimation = '';

    /**
     * descriptionColor
     *
     * @var string
     */
    protected string $descriptionColor = '';

    /**
     * descriptionSize
     *
     * @var string
     */
    protected string $descriptionSize = '';

    /**
     * buttonText
     *
     * @var string
     */
    protected string $buttonText = '';

    /**
     * buttonLink
     *
     * @var string
     */
    protected string $buttonLink = '';

    /**
     * buttonAnimation
     *
     * @var string
     */
    protected string $buttonAnimation = '';

    /**
     * buttonTextColor
     *
     * @var string
     */
    protected string $buttonTextColor = '';

    /**
     * buttonTextSize
     *
     * @var string
     */
    protected string $buttonTextSize = '';

    /**
     * boxBgColor
     *
     * @var string
     */
    protected string $boxBgColor = '';

    /**
     * boxTextColor
     *
     * @var string
     */
    protected string $boxTextColor = '';

    /**
     * boxBgTransOpacity
     *
     * @var string
     */
    protected string $boxBgTransOpacity = '';

    /**
     * boxPositionX
     *
     * @var string
     */
    protected string $boxPositionX = '';

    /**
     * boxPositionY
     *
     * @var string
     */
    protected string $boxPositionY = '';

    /**
     * boxAnimation
     *
     * @var string
     */
    protected string $boxAnimation = '';

    /**
     * boxHeight
     *
     * @var string
     */
    protected string $boxHeight = '';

    /**
     * headlinePositionX
     *
     * @var string
     */
    protected string $headlinePositionX = '';

    /**
     * headlinePositionY
     *
     * @var string
     */
    protected string $headlinePositionY = '';

    /**
     * descriptionPositionX
     *
     * @var string
     */
    protected string $descriptionPositionX = '';

    /**
     * descriptionPositionY
     *
     * @var string
     */
    protected string $descriptionPositionY = '';

    /**
     * buttonPositionX
     *
     * @var string
     */
    protected string $buttonPositionX = '';

    /**
     * buttonPositionY
     *
     * @var string
     */
    protected string $buttonPositionY = '';

    /**
     * boxWidth
     *
     * @var string
     */
    protected string $boxWidth = '';

    /**
     * boxCheck
     *
     * @var string
     */
    protected string $boxCheck = '';

    /**
     * Returns the slideEffect
     *
     * @return string $slideEffect
     */
    public function getSlideEffect(): string
    {
        return $this->slideEffect;
    }

    /**
     * Sets the slideEffect
     *
     * @param string $slideEffect
     */
    public function setSlideEffect(string $slideEffect): void
    {
        $this->slideEffect = $slideEffect;
    }

    /**
     * Returns the dataDuration
     *
     * @return string $DataDuration
     */
    public function getDataDuration(): string
    {
        return $this->dataDuration;
    }

    /**
     * Sets the dataDuration
     *
     * @param string $dataDuration
     */
    public function setDataDuration(string $dataDuration): void
    {
        $this->dataDuration = $dataDuration;
    }

    /**
     * Returns the image
     *
     * @return ?FileReference $image
     */
    public function getImage(): ?FileReference
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param FileReference $image
     */
    public function setImage(FileReference $image): void
    {
        $this->image = $image;
    }

    /**
     * Returns the headline
     *
     * @return string $headline
     */
    public function getHeadline(): string
    {
        return $this->headline;
    }

    /**
     * Sets the headline
     *
     * @param string $headline
     */
    public function setHeadline(string $headline): void
    {
        $this->headline = $headline;
    }

    /**
     * Returns the headlineAnimation
     *
     * @return string $headlineAnimation
     */
    public function getHeadlineAnimation(): string
    {
        return $this->headlineAnimation;
    }

    /**
     * Sets the headlineAnimation
     *
     * @param string $headlineAnimation
     */
    public function setHeadlineAnimation(string $headlineAnimation): void
    {
        $this->headlineAnimation = $headlineAnimation;
    }

    /**
     * Returns the headlineColor
     *
     * @return string $headlineColor
     */
    public function getHeadlineColor(): string
    {
        return $this->headlineColor;
    }

    /**
     * Sets the headlineColor
     *
     * @param string $headlineColor
     */
    public function setHeadlineColor(string $headlineColor): void
    {
        $this->headlineColor = $headlineColor;
    }

    /**
     * Returns the headlineSize
     *
     * @return string $headlineSize
     */
    public function getHeadlineSize(): string
    {
        return $this->headlineSize;
    }

    /**
     * Sets the headlineSize
     *
     * @param string $headlineSize
     */
    public function setHeadlineSize(string $headlineSize): void
    {
        $this->headlineSize = $headlineSize;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * Returns the descriptionAnimation
     *
     * @return string $descriptionAnimation
     */
    public function getDescriptionAnimation(): string
    {
        return $this->descriptionAnimation;
    }

    /**
     * Sets the descriptionAnimation
     *
     * @param string $descriptionAnimation
     */
    public function setDescriptionAnimation(string $descriptionAnimation): void
    {
        $this->descriptionAnimation = $descriptionAnimation;
    }

    /**
     * Returns the descriptionColor
     *
     * @return string $descriptionColor
     */
    public function getDescriptionColor(): string
    {
        return $this->descriptionColor;
    }

    /**
     * Sets the descriptionColor
     *
     * @param string $descriptionColor
     */
    public function setDescriptionColor(string $descriptionColor): void
    {
        $this->descriptionColor = $descriptionColor;
    }

    /**
     * Returns the descriptionSize
     *
     * @return string $descriptionSize
     */
    public function getDescriptionSize(): string
    {
        return $this->descriptionSize;
    }

    /**
     * Sets the descriptionSize
     *
     * @param string $descriptionSize
     */
    public function setDescriptionSize(string $descriptionSize): void
    {
        $this->descriptionSize = $descriptionSize;
    }

    /**
     * Returns the buttonText
     *
     * @return string $buttonText
     */
    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    /**
     * Sets the buttonText
     *
     * @param string $buttonText
     */
    public function setButtonText(string $buttonText): void
    {
        $this->buttonText = $buttonText;
    }

    /**
     * Returns the buttonLink
     *
     * @return string $buttonLink
     */
    public function getButtonLink(): string
    {
        return $this->buttonLink;
    }

    /**
     * Sets the buttonLink
     *
     * @param string $buttonLink
     */
    public function setButtonLink(string $buttonLink): void
    {
        $this->buttonLink = $buttonLink;
    }

    /**
     * Returns the buttonAnimation
     *
     * @return string $buttonAnimation
     */
    public function getButtonAnimation(): string
    {
        return $this->buttonAnimation;
    }

    /**
     * Sets the buttonAnimation
     *
     * @param string $buttonAnimation
     */
    public function setButtonAnimation(string $buttonAnimation): void
    {
        $this->buttonAnimation = $buttonAnimation;
    }

    /**
     * Returns the buttonTextColor
     *
     * @return string $buttonTextColor
     */
    public function getButtonTextColor(): string
    {
        return $this->buttonTextColor;
    }

    /**
     * Sets the buttonTextColor
     *
     * @param string $buttonTextColor
     */
    public function setButtonTextColor(string $buttonTextColor): void
    {
        $this->buttonTextColor = $buttonTextColor;
    }

    /**
     * Returns the buttonTextSize
     *
     * @return string $buttonTextSize
     */
    public function getButtonTextSize(): string
    {
        return $this->buttonTextSize;
    }

    /**
     * Sets the buttonTextSize
     *
     * @param string $buttonTextSize
     */
    public function setButtonTextSize(string $buttonTextSize): void
    {
        $this->buttonTextSize = $buttonTextSize;
    }

    /**
     * Returns the boxBgColor
     *
     * @return string $boxBgColor
     */
    public function getBoxBgColor(): string
    {
        return $this->boxBgColor;
    }

    /**
     * Sets the boxBgColor
     *
     * @param string $boxBgColor
     */
    public function setBoxBgColor(string $boxBgColor): void
    {
        $this->boxBgColor = $boxBgColor;
    }

    /**
     * Returns the boxTextColor
     *
     * @return string $boxTextColor
     */
    public function getBoxTextColor(): string
    {
        return $this->boxTextColor;
    }

    /**
     * Sets the boxTextColor
     *
     * @param string $boxTextColor
     */
    public function setBoxTextColor(string $boxTextColor): void
    {
        $this->boxTextColor = $boxTextColor;
    }

    /**
     * Returns the boxBgTransOpacity
     *
     * @return string $boxBgTransOpacity
     */
    public function getBoxBgTransOpacity(): string
    {
        return $this->boxBgTransOpacity;
    }

    /**
     * Sets the boxBgTransOpacity
     *
     * @param string $boxBgTransOpacity
     */
    public function setBoxBgTransOpacity(string $boxBgTransOpacity): void
    {
        $this->boxBgTransOpacity = $boxBgTransOpacity;
    }

    /**
     * Returns the boxPositionX
     *
     * @return string $boxPositionX
     */
    public function getBoxPositionX(): string
    {
        return $this->boxPositionX;
    }

    /**
     * Sets the boxPositionX
     *
     * @param string $boxPositionX
     */
    public function setBoxPositionX(string $boxPositionX): void
    {
        $this->boxPositionX = $boxPositionX;
    }

    /**
     * Returns the boxPositionY
     *
     * @return string $boxPositionY
     */
    public function getBoxPositionY(): string
    {
        return $this->boxPositionY;
    }

    /**
     * Sets the boxPositionY
     *
     * @param string $boxPositionY
     */
    public function setBoxPositionY(string $boxPositionY): void
    {
        $this->boxPositionY = $boxPositionY;
    }

    /**
    * Returns the boxAnimation
    *
    * @return string $boxAnimation
    */
    public function getBoxAnimation(): string
    {
        return $this->boxAnimation;
    }

    /**
     * Sets the boxAnimation
     *
     * @param string $boxAnimation
     */
    public function setBoxAnimation(string $boxAnimation): void
    {
        $this->boxAnimation = $boxAnimation;
    }

    /**
     * Returns the boxHeight
     *
     * @return string $boxHeight
     */
    public function getBoxHeight(): string
    {
        return $this->boxHeight;
    }

    /**
     * Sets the boxHeight
     *
     * @param string $boxHeight
     */
    public function setBoxHeight(string $boxHeight): void
    {
        $this->boxHeight = $boxHeight;
    }

    /**
     * Returns the headlinePositionX
     *
     * @return string $headlinePositionX
     */
    public function getHeadlinePositionX(): string
    {
        return $this->headlinePositionX;
    }

    /**
     * Sets the headlinePositionX
     *
     * @param string $headlinePositionX
     */
    public function setHeadlinePositionX($headlinePositionX): void
    {
        $this->headlinePositionX = $headlinePositionX;
    }

    /**
     * Returns the headlinePositionY
     *
     * @return string $headlinePositionY
     */
    public function getHeadlinePositionY(): string
    {
        return $this->headlinePositionY;
    }

    /**
     * Sets the headlinePositionY
     *
     * @param string $headlinePositionY
     */
    public function setHeadlinePositionY(string $headlinePositionY): void
    {
        $this->headlinePositionY = $headlinePositionY;
    }

    /**
     * Returns the descriptionPositionX
     *
     * @return string $descriptionPositionX
     */
    public function getDescriptionPositionX(): string
    {
        return $this->descriptionPositionX;
    }

    /**
     * Sets the descriptionPositionX
     *
     * @param string $descriptionPositionX
     */
    public function setDescriptionPositionX(string $descriptionPositionX): void
    {
        $this->descriptionPositionX = $descriptionPositionX;
    }

    /**
     * Returns the descriptionPositionY
     *
     * @return string $descriptionPositionY
     */
    public function getDescriptionPositionY(): string
    {
        return $this->descriptionPositionY;
    }

    /**
     * Sets the descriptionPositionY
     *
     * @param string $descriptionPositionY
     */
    public function setDescriptionPositionY(string $descriptionPositionY): void
    {
        $this->descriptionPositionY = $descriptionPositionY;
    }

    /**
     * Returns the buttonPositionX
     *
     * @return string $buttonPositionX
     */
    public function getButtonPositionX(): string
    {
        return $this->buttonPositionX;
    }

    /**
     * Sets the buttonPositionX
     *
     * @param string $buttonPositionX
     */
    public function setButtonPositionX(string $buttonPositionX): void
    {
        $this->buttonPositionX = $buttonPositionX;
    }

    /**
     * Returns the buttonPositionY
     *
     * @return string $buttonPositionY
     */
    public function getButtonPositionY(): string
    {
        return $this->buttonPositionY;
    }

    /**
     * Sets the buttonPositionY
     *
     * @param string $buttonPositionY
     */
    public function setButtonPositionY(string $buttonPositionY): void
    {
        $this->buttonPositionY = $buttonPositionY;
    }

    /**
     * Returns the boxWidth
     *
     * @return string $boxWidth
     */
    public function getBoxWidth(): string
    {
        return $this->boxWidth;
    }

    /**
     * Sets the boxWidth
     *
     * @param string $boxWidth
     */
    public function setBoxWidth(string $boxWidth): void
    {
        $this->boxWidth = $boxWidth;
    }

    /**
     * Returns the boxCheck
     *
     * @return string $boxCheck
     */
    public function getBoxCheck(): string
    {
        return $this->boxCheck;
    }

    /**
     * Sets the boxCheck
     *
     * @param string $boxCheck
     */
    public function setBoxCheck(string $boxCheck): void
    {
        $this->boxCheck = $boxCheck;
    }
}
