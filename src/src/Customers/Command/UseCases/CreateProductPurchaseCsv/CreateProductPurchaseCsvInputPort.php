<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv;

use DateTimeInterface;

interface CreateProductPurchaseCsvInputPort
{
    public function providerId(): string;

    public function contractId(): string;

    public function from(): DateTimeInterface;

    public function to(): DateTimeInterface;
}
