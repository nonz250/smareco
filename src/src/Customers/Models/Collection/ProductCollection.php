<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Collection;

use InvalidArgumentException;
use Smareco\Customers\Models\Entities\Product;
use Smareco\Customers\Models\ValueObjects\TaxDivision;
use Smareco\Foundation\Collection;

class ProductCollection extends Collection
{
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->validate($item);
        }
        $this->items = $items;
    }

    public function toArray(): array
    {
        $array = [];
        /** @var Product $item */
        foreach ($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    public static function fromArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new Product(
                (string) $item['id'],
                (string) $item['providerId'],
                (string) $item['contractId'],
                (int) $item['productId'],
                (int) $item['categoryId'],
                (string) $item['productCode'],
                (string) $item['productName'],
                (string) $item['productKana'],
                new TaxDivision((int) $item['taxDivision']),
                (int) $item['price'],
                (int) $item['customerPrice'],
                (int) $item['cost'],
                (string) $item['description'],
            );
        }
        return new self($array);
    }

    protected function validate($item): void
    {
        if (!$item instanceof Product) {
            throw new InvalidArgumentException('Product Collection must be Product type.');
        }
    }
}
