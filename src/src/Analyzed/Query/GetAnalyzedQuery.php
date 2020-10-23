<?php
declare(strict_types=1);

namespace Smareco\Analyzed\Query;

interface GetAnalyzedQuery
{
    public function findLatestByContractId(string $providerId, string $contractId);
}
