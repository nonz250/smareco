<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Repositories;

use RuntimeException;
use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;

class SyncNecessaryRepository implements SyncNecessaryRepositoryInterface
{
    private \App\Models\SyncNecessary $syncNecessary;

    /**
     * SyncNecessaryRepository constructor.
     *
     * @param \App\Models\SyncNecessary $syncNecessary
     */
    public function __construct(\App\Models\SyncNecessary $syncNecessary)
    {
        $this->syncNecessary = $syncNecessary;
    }

    public function save(SyncNecessary $syncNecessary): SyncNecessary
    {
        $syncNecessaryModel = $this->syncNecessary->newQuery()->firstOrNew([
            'id' => (string) $syncNecessary->id(),
        ])->fill([
            'provider_id' => (string) $syncNecessary->providerId(),
            'contract_id' => (string) $syncNecessary->contractId(),
            'target' => (string) $syncNecessary->target(),
            'field' => (string) $syncNecessary->field(),
        ]);

        if (!$syncNecessaryModel->save()) {
            throw new RuntimeException('Webhookイベントを保存できませんでした。');
        }

        return $syncNecessary;
    }
}
