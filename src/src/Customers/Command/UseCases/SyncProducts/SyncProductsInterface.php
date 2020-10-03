<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncProducts;

interface SyncProductsInterface
{
    public function process(SyncProductsInputPort $inputPort, SyncProductsOutputPort $outputPort): void;
}
