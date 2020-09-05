<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Shared\Models\Entities\SyncNecessary;

interface SyncNecessaryRepositoryInterface
{
    public function save(SyncNecessary $syncNecessary): SyncNecessary;
}
