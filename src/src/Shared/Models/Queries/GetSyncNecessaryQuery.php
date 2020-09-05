<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Queries;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Entities\SyncNecessary;

interface GetSyncNecessaryQuery
{
    /**
     * @param string $providerId
     * @param string $contractId
     * @throws SmarecoSpecificationExceptionInterface
     * @return SyncNecessary|null
     */
    public function findLatest(string $providerId, string $contractId): ?SyncNecessary;
}
