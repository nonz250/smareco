<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Collection;

use InvalidArgumentException;
use Smareco\Customers\Models\Entities\TransactionDetail;
use Smareco\Foundation\Collection;

class TransactionDetailCollection extends Collection
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
        /** @var TransactionDetail $item */
        foreach ($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    public static function fromArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new TransactionDetail(
                (string) $item['product_id'],
                (string) $item['product_code'],
                (string) $item['product_name'],
                (int) $item['price'],
                (int) $item['quantity'],
            );
        }
        return new self($array);
    }

    public static function fromApiArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            if ($item['productId']) {
                $array[] = new TransactionDetail(
                    (string) $item['productId'],
                    (string) $item['productCode'],
                    (string) $item['productName'],
                    (int) $item['price'],
                    (int) $item['quantity'],
                );
            }
        }
        return new self($array);
    }

    protected function validate($item): void
    {
        if (!$item instanceof TransactionDetail) {
            throw new InvalidArgumentException('TransactionDetailCollection must be TransactionDetail type.');
        }
    }
}
