<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Models\Repositories;

use Smareco\AIProcessHistory\Models\Entities\AIProcessEntity;

interface AIProcessRepositoryInterface
{
    public function findByContractId(string $contractId): AIProcessEntity;

    public function save(AIProcessEntity $AIProcessEntity): void;
}
