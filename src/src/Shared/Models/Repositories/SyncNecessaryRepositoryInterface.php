<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\ValueObjects\Target;

interface SyncNecessaryRepositoryInterface
{
    public function find(string $providerId, string $contractId, Target $target): ?SyncNecessary;

    public function save(SyncNecessary $syncNecessary): SyncNecessary;

    /**
     * @param SyncNecessary $syncNecessary
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function delete(SyncNecessary $syncNecessary): void;
}
