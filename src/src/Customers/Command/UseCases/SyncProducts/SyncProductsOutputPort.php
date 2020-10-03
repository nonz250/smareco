<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncProducts;

use Smareco\Shared\Models\Entities\SyncHistory;

interface SyncProductsOutputPort
{
    public function output(SyncHistory $product): void;
}
