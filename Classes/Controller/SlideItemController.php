<?php
namespace NITSAN\NsRevolutionSlider\Controller;

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
 * SlideItemController
 */
class SlideItemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $slideItems = $this->slideItemRepository->findAll();
        $this->view->assign('slideItems', $slideItems);
    }
}
