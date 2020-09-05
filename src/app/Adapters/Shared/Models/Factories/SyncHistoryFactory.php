<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Smareco\Shared\Models\Entities\SyncHistory;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;

class SyncHistoryFactory implements SyncHistoryFactoryInterface
{
    private \App\Models\SyncHistory $syncHistory;

    /**
     * SyncHistoryFactory constructor.
     *
     * @param \App\Models\SyncHistory $syncHistory
     */
    public function __construct(\App\Models\SyncHistory $syncHistory)
    {
        $this->syncHistory = $syncHistory;
    }

    public function newSyncHistory(string $providerId, string $contractId, Target $target): SyncHistory
    {
        return new SyncHistory(
            (string) Str::uuid(),
            (string) $providerId,
            (string) $contractId,
            $target,
            Carbon::now()
        );
    }
}
