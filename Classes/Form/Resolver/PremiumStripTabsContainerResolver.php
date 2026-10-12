<?php

declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\Form\Resolver;

use NITSAN\NsRevolutionSlider\Form\Container\PremiumStripTabsContainer;
use TYPO3\CMS\Backend\Form\NodeFactory;
use TYPO3\CMS\Backend\Form\NodeResolverInterface;

/**
 * Uses PremiumStripTabsContainer for the main edit form of Slider Revolution content elements.
 */
final class PremiumStripTabsContainerResolver implements NodeResolverInterface
{
    private const PLUGIN_SIGNATURE = 'nsrevolutionslider_slider';

    private array $data;

    /**
     * TYPO3 v12 passes the node factory and data to the constructor, v13+ calls setData().
     */
    public function __construct(?NodeFactory $nodeFactory = null, array $data = [])
    {
        $this->data = $data;
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function resolve(): ?string
    {
        if (($this->data['tableName'] ?? '') !== 'tt_content' || !empty($this->data['isInlineChild'])) {
            return null;
        }

        $recordType = (string)($this->data['recordTypeValue'] ?? '');
        if ($recordType === self::PLUGIN_SIGNATURE) {
            return PremiumStripTabsContainer::class;
        }

        $listType = $this->data['databaseRow']['list_type'] ?? '';
        if (is_array($listType)) {
            $listType = (string)($listType[0] ?? '');
        }

        return $recordType === 'list' && $listType === self::PLUGIN_SIGNATURE ? PremiumStripTabsContainer::class : null;
    }
}
