<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Repositories;

use Smareco\Customers\Models\Collection\ProductCollection;
use Smareco\Customers\Models\Entities\Product;
use Smareco\Shared\Models\ValueObjects\AccessToken;

interface ProductRepositoryInterface
{
    public function findProductFromApiForPaginate(
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): ProductCollection;

    public function saveToStorage(Product $product): void;
}
