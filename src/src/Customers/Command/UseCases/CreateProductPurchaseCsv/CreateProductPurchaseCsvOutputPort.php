<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv;

interface CreateProductPurchaseCsvOutputPort
{
    public function output(string $csvPath): void;
}
