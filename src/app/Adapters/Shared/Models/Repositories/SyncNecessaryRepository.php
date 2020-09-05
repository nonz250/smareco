<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Repositories;

use RuntimeException;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;
use Throwable;

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

    public function find(string $providerId, string $contractId, Target $target): ?SyncNecessary
    {
        $syncNecessaryModel = $this->syncNecessary->newQuery()
            ->where('provider_id', $providerId)
            ->where('contract_id', $contractId)
            ->where('target', (string) $target)
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

    public function save(SyncNecessary $syncNecessary): SyncNecessary
    {
        $syncNecessaryModel = $this->syncNecessary->newQuery()->firstOrNew([
            'provider_id' => (string) $syncNecessary->providerId(),
            'contract_id' => (string) $syncNecessary->contractId(),
            'target' => (string) $syncNecessary->target(),
        ])->fill([
            'field' => (string) $syncNecessary->field(),
        ]);

        if (!$syncNecessaryModel->getAttribute('id')) {
            $syncNecessaryModel->setAttribute('id', $syncNecessary->id());
        }

        if (!$syncNecessaryModel->save()) {
            throw new RuntimeException('Webhookイベントを保存できませんでした。');
        }

        return $syncNecessary;
    }

    public function delete(SyncNecessary $syncNecessary): void
    {
        $syncNecessaryModel = $this->syncNecessary->newQuery()
            ->find($syncNecessary->id());
        try {
            if ($syncNecessaryModel === null) {
                throw new RuntimeException('削除すべきデータがありません。');
            }
            $syncNecessaryModel->delete();
        } catch (Throwable $e) {
            throw new SmarecoSpecificationException('削除に失敗しました。', 500, $e);
        }
    }
}
