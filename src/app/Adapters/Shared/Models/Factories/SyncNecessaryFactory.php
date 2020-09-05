<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Factories;

use Illuminate\Support\Str;
use Smareco\Shared\Models\Entities\SyncNecessary;
use Smareco\Shared\Models\Factories\SyncNecessaryFactoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;

class SyncNecessaryFactory implements SyncNecessaryFactoryInterface
{
    public function newSyncNecessary(
        string $providerId,
        string $contractId,
        Target $target,
        string $field
    ): SyncNecessary {
        return new SyncNecessary(
            (string) Str::uuid(),
            $providerId,
            $contractId,
            $target,
            $field
        );
    }
}
