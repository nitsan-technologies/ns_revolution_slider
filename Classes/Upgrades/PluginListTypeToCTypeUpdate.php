<?php
declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\Upgrades;

use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;

#[UpgradeWizard('ns_revolution_pluginListTypeToCTypeUpdate')]
final class PluginListTypeToCTypeUpdate implements UpgradeWizardInterface
{
    public function getIdentifier(): string
    {
        return 'nsRevolutionSliderPluginListTypeToCType';
    }

    public function getTitle(): string
    {
        return 'Migrate plugin to CType "slider"';
    }

    public function getDescription(): string
    {
        return 'Updates tt_content records to CType "slider". Supports both list_type and flexform detection.';
    }

    /**
     * Check if list_type column exists
     */
    protected function hasListTypeColumn(): bool
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $columns = $connection->createSchemaManager()->listTableColumns('tt_content');
        return isset($columns['list_type']);
    }

    /**
     * Get records to migrate
     */
    protected function getMigrationRecords(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');

        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        // ✅ CASE 1: If list_type exists
        if ($this->hasListTypeColumn()) {
            return $queryBuilder
                ->select('uid')
                ->from('tt_content')
                ->where(
                    $queryBuilder->expr()->eq(
                        'CType',
                        $queryBuilder->createNamedParameter('list')
                    ),
                    $queryBuilder->expr()->eq(
                        'list_type',
                        $queryBuilder->createNamedParameter('nsrevolutionslider_slider')
                    )
                )
                ->executeQuery()
                ->fetchAllAssociative();
        }

        // ✅ CASE 2: Fallback → detect via flexform
        return $queryBuilder
            ->select('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq(
                    'CType',
                    $queryBuilder->createNamedParameter('list')
                ),
                $queryBuilder->expr()->like(
                    'pi_flexform',
                    $queryBuilder->createNamedParameter('%nsrevolutionslider_slider%')
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }

    /**
     * Update single record
     */
    protected function updateRow(int $uid): void
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $connection->update(
            'tt_content',
            [
                'CType' => 'slider',   // ✅ your custom CType
                'list_type' => ''      // safe: ignored if column doesn't exist
            ],
            ['uid' => $uid]
        );
    }

    /**
     * Execute migration
     */
    public function executeUpdate(): bool
    {
        $records = $this->getMigrationRecords();

        foreach ($records as $row) {
            $this->updateRow((int)$row['uid']);
        }

        return true;
    }

    /**
     * Check if update is needed
     */
    public function updateNecessary(): bool
    {
        return !empty($this->getMigrationRecords());
    }

    public function getPrerequisites(): array
    {
        return [];
    }
}