<?php
declare(strict_types=1);

namespace App\Adapters\Customers\CreateProductPurchaseCsv;

use Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv\CreateProductPurchaseCsvOutputPort;

class CreateProductPurchaseCsvOutput implements CreateProductPurchaseCsvOutputPort
{
    private string $csvPath;

    public function output(string $csvPath): void
    {
        $this->csvPath = $csvPath;
    }

    public function csvPath(): string
    {
        return $this->csvPath;
    }
}
