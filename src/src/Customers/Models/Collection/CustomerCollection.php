<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Collection;

use DateTime;
use InvalidArgumentException;
use Smareco\Customers\Models\ValueObjects\Customer;
use Smareco\Foundation\Collection;

class CustomerCollection extends Collection
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
        /** @var Customer $item */
        foreach ($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    public static function fromArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new Customer(
                (string) $item['id'],
                (string) $item['code'],
                (string) $item['rank'],
                (string) ($item['lastName'] . ' ' . $item['firstName']),
                (string) ($item['lastKana'] . ' ' . $item['firstKana']),
                (string) ($item['mailAddress'] ?? $item['mailAddress2'] ?? $item['mailAddress3']),
                (string) $item['sex'],
                DateTime::createFromFormat('Y/m/d H:i:s', $item['birthDate']),
                (string) $item['storeId'],
                (string) $item['mailReceiveFlag']
            );
        }
        return new self($array);
    }

    protected function validate($item): void
    {
        if (!$item instanceof Customer) {
            throw new InvalidArgumentException('Customer Collection must be Customer type.');
        }
    }
}
