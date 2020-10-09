<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Models\Factories;

use Smareco\AIProcessHistory\Models\Entities\AIProcessEntity;

interface AIProcessFactoryInterface
{
    public function newEntity(string $contractId): AIProcessEntity;
}
