<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv;

interface CreateProductPurchaseCsvInterface
{
    public function process(CreateProductPurchaseCsvInputPort $inputPort, CreateProductPurchaseCsvOutputPort $outputPort): void;
}
