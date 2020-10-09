<?php
declare(strict_types=1);

namespace App\Adapters\AIProcessHistory\Models\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Smareco\AIProcessHistory\Models\Entities\AIProcessEntity;
use Smareco\AIProcessHistory\Models\Factories\AIProcessFactoryInterface;
use Smareco\AIProcessHistory\Models\ValueObject\ProcessStatus;

class AIProcessFactory implements AIProcessFactoryInterface
{
    public function newEntity(string $contractId): AIProcessEntity
    {
        return new AIProcessEntity(
            Str::uuid()->toString(),
            $contractId,
            new ProcessStatus(ProcessStatus::STATUS_END_PROCESS),
            Carbon::now()
        );
    }
}
