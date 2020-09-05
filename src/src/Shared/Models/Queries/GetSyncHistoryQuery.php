<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Queries;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Entities\SyncHistory;

interface GetSyncHistoryQuery
{
    /**
     * @param string $providerId
     * @param string $contractId
     * @throws SmarecoSpecificationExceptionInterface
     * @return SyncHistory|null
     */
    public function findLatest(string $providerId, string $contractId): ?SyncHistory;
}
