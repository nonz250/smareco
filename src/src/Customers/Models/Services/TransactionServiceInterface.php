<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Services;

use Smareco\Customers\Models\Collection\TransactionHeadCollection;

interface TransactionServiceInterface
{
    public function CreateProductPurchaseCsv(string $contractId, TransactionHeadCollection $transactionHeadCollection): string;
}
