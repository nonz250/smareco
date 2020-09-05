<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\ReadModels;

use Carbon\Carbon;
use Smareco\Shared\Models\Entities\SyncHistory;
use Smareco\Shared\Models\Queries\GetSyncHistoryQuery;
use Smareco\Shared\Models\ValueObjects\Target;

class GetSyncHistory implements GetSyncHistoryQuery
{
    private \App\Models\SyncHistory $syncHistory;

    /**
     * GetSyncHistory constructor.
     *
     * @param \App\Models\SyncHistory $syncHistory
     */
    public function __construct(\App\Models\SyncHistory $syncHistory)
    {
        $this->syncHistory = $syncHistory;
    }

    public function findLatest(string $providerId, string $contractId): SyncHistory
    {
        $syncHistoryModel = $this->syncHistory->newQuery()
            ->where('provider_id', $providerId)
            ->where('contract_id', $contractId)
            ->latest('sync_datetime')
            ->first();
        return new SyncHistory(
            (string) $syncHistoryModel->getAttribute('id'),
            (string) $syncHistoryModel->getAttribute('provider_id'),
            (string) $syncHistoryModel->getAttribute('contract_id'),
            new Target((string) $syncHistoryModel->getAttribute('target')),
            Carbon::parse((string) $syncHistoryModel->getAttribute('sync_datetime')),
        );
    }
}
