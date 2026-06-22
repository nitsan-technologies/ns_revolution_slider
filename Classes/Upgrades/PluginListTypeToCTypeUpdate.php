<?php

declare(strict_types=1);

namespace NITSAN\NsRevolutionSlider\Upgrades;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

#[UpgradeWizard('nsRevolutionSliderPluginListTypeToCTypeUpdate')]
final class PluginListTypeToCTypeUpdate implements UpgradeWizardInterface
{
    private const PLUGIN_SIGNATURE = 'nsrevolutionslider_slider';

    /**
     * Legacy CType used by an earlier migration wizard version.
     */
    private const LEGACY_MIGRATED_CTYPE = 'slider';

    public function getIdentifier(): string
    {
        return 'nsRevolutionSliderPluginListTypeToCType';
    }

    public function getTitle(): string
    {
        return 'Migrate Revolution Slider plugins to content elements';
    }

    public function getDescription(): string
    {
        return 'Updates tt_content records from list_type "nsrevolutionslider_slider" to CType "nsrevolutionslider_slider". Also fixes records migrated to the legacy CType "slider".';
    }

    public function getPrerequisites(): array
    {
        return [];
    }

    public function updateNecessary(): bool
    {
        // list_type plugins are the correct format on TYPO3 v12/v13 — only migrate on v14+.
        if ((new Typo3Version())->getMajorVersion() < 14) {
            return false;
        }

        return $this->hasListTypeRecordsToMigrate() || $this->hasIncorrectSliderCTypeRecords();
    }

    public function executeUpdate(): bool
    {
        foreach ($this->getListTypeRecordsToMigrate() as $record) {
            $this->updateContentElement((int)$record['uid']);
        }

        foreach ($this->getIncorrectSliderCTypeRecords() as $record) {
            $this->fixIncorrectSliderCType((int)$record['uid']);
        }

        return true;
    }

    private function hasListTypeColumn(): bool
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $columns = $connection->createSchemaManager()->listTableColumns('tt_content');

        return isset($columns['list_type']);
    }

    private function hasListTypeRecordsToMigrate(): bool
    {
        return $this->getListTypeRecordsToMigrate() !== [];
    }

    /**
     * @return list<array{uid: int|string}>
     */
    private function getListTypeRecordsToMigrate(): array
    {
        if (!$this->hasListTypeColumn()) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

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
                    $queryBuilder->createNamedParameter(self::PLUGIN_SIGNATURE)
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }

    private function hasIncorrectSliderCTypeRecords(): bool
    {
        return $this->getIncorrectSliderCTypeRecords() !== [];
    }

    /**
     * @return list<array{uid: int|string}>
     */
    private function getIncorrectSliderCTypeRecords(): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tt_content');
        $queryBuilder->getRestrictions()
            ->removeAll()
            ->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        return $queryBuilder
            ->select('uid')
            ->from('tt_content')
            ->where(
                $queryBuilder->expr()->eq(
                    'CType',
                    $queryBuilder->createNamedParameter(self::LEGACY_MIGRATED_CTYPE)
                )
            )
            ->executeQuery()
            ->fetchAllAssociative();
    }

    private function updateContentElement(int $uid): void
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $updateFields = ['CType' => self::PLUGIN_SIGNATURE];
        if ($this->hasListTypeColumn()) {
            $updateFields['list_type'] = '';
        }

        $connection->update(
            'tt_content',
            $updateFields,
            ['uid' => $uid]
        );
    }

    private function fixIncorrectSliderCType(int $uid): void
    {
        GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content')
            ->update(
                'tt_content',
                ['CType' => self::PLUGIN_SIGNATURE],
                ['uid' => $uid]
            );
    }
}
