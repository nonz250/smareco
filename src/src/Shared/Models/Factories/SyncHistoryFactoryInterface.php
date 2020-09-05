<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Factories;

use Smareco\Shared\Models\Entities\SyncHistory;
use Smareco\Shared\Models\ValueObjects\Target;

interface SyncHistoryFactoryInterface
{
    /**
     * @param string $providerId
     * @param string $contractId
     * @param Target $target
     * @return SyncHistory
     */
    public function newSyncHistory(string $providerId, string $contractId, Target $target): SyncHistory;
}
