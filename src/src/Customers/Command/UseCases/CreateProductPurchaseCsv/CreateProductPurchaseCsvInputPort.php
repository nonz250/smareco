<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv;

interface CreateProductPurchaseCsvInputPort
{
    public function contractId(): string;
}
