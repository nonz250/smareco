<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Factories;

use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\ValueObjects\Target;

interface SyncNecessaryFactoryInterface
{
    /**
     * @param string $providerId
     * @param string $contractId
     * @param Target $target
     * @param string $field
     * @return SyncNecessary
     */
    public function newSyncNecessary(string $providerId, string $contractId, Target $target, string $field): SyncNecessary;
}
