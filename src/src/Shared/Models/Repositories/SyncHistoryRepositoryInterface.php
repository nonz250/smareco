<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Shared\Models\Entities\SyncHistory;

interface SyncHistoryRepositoryInterface
{
    /**
     * @param SyncHistory $syncHistory
     * @return SyncHistory
     */
    public function save(SyncHistory $syncHistory): SyncHistory;
}
