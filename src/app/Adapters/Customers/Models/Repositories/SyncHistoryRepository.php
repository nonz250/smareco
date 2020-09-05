<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\Repositories;

use RuntimeException;
use Smareco\Shared\Models\Entities\SyncHistory;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;

class SyncHistoryRepository implements SyncHistoryRepositoryInterface
{
    private \App\Models\SyncHistory $syncHistory;

    /**
     * SyncHistoryRepository constructor.
     *
     * @param \App\Models\SyncHistory $syncHistory
     */
    public function __construct(\App\Models\SyncHistory $syncHistory)
    {
        $this->syncHistory = $syncHistory;
    }

    public function save(SyncHistory $syncHistory): SyncHistory
    {
        $syncHistoryModel = $this->syncHistory->newQuery()->firstOrNew([
            'id' => $syncHistory->id(),
        ])->fill([
            'provider_id' => (string) $syncHistory->providerId(),
            'contract_id' => (string) $syncHistory->contractId(),
            'target' => (string) $syncHistory->target(),
            'sync_datetime' => (string) $syncHistory->syncDatetime()->format('Y/m/d H:i:s'),
        ]);

        if (!$syncHistoryModel->save()) {
            throw new RuntimeException('同期履歴の保存に失敗しました。');
        }

        return $syncHistory;
    }
}
