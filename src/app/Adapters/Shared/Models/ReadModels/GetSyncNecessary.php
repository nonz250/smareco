<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\ReadModels;

use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\Queries\GetSyncNecessaryQuery;
use Smareco\Shared\Models\ValueObjects\Target;

class GetSyncNecessary implements GetSyncNecessaryQuery
{
    private \App\Models\SyncNecessary $syncNecessary;

    /**
     * GetSyncNecessary constructor.
     *
     * @param \App\Models\SyncNecessary $syncNecessary
     */
    public function __construct(\App\Models\SyncNecessary $syncNecessary)
    {
        $this->syncNecessary = $syncNecessary;
    }

    public function findLatest(string $providerId, string $contractId): ?SyncNecessary
    {
        $syncNecessaryModel = $this->syncNecessary->newQuery()
            ->where('provider_id', $providerId)
            ->where('contract_id', $contractId)
            ->first();

        if ($syncNecessaryModel === null) {
            return null;
        }

        return new SyncNecessary(
            (string) $syncNecessaryModel->getAttribute('id'),
            (string) $syncNecessaryModel->getAttribute('provider_id'),
            (string) $syncNecessaryModel->getAttribute('contract_id'),
            new Target((string) $syncNecessaryModel->getAttribute('target')),
            (string) $syncNecessaryModel->getAttribute('field'),
        );
    }
}
