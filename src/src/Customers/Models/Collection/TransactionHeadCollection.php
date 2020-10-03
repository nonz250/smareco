<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Collection;

use DateTime;
use InvalidArgumentException;
use Smareco\Customers\Models\Entities\TransactionHead;
use Smareco\Foundation\Collection;
use Smareco\Shared\Models\ValueObjects\CancelDivision;

class TransactionHeadCollection extends Collection
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
        /** @var TransactionHead $item */
        foreach ($this->items as $item) {
            $array[] = $item->toArray();
        }
        return $array;
    }

    public static function fromArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new TransactionHead(
                (string) $item['id'],
                (string) $item['provider_id'],
                (string) $item['contract_id'],
                (string) $item['transaction_head_id'],
                DateTime::createFromFormat('Y-m-d H:i:s', (string) $item['transaction_datetime']),
                new CancelDivision((int) $item['cancel_division']),
                (int) $item['total'],
                (int) $item['point_discount'],
                (int) $item['amount'],
                (string) $item['store_id'],
                (string) $item['customer_id'],
                (string) $item['customer_code'],
                TransactionDetailCollection::fromArray($item['transaction_detail'])
            );
        }
        return new self($array);
    }

    public static function fromApiArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new TransactionHead(
                (string) $item['id'],
                (string) $item['providerId'],
                (string) $item['contractId'],
                (string) $item['transactionHeadId'],
                DateTime::createFromFormat('Y-m-d\TH:i:sP', (string) $item['transactionDateTime']),
                new CancelDivision((int) $item['cancelDivision']),
                (int) $item['total'],
                (int) $item['pointDiscount'],
                (int) $item['amount'],
                (string) $item['storeId'],
                (string) $item['customerId'],
                (string) $item['customerCode'],
                TransactionDetailCollection::fromApiArray($item['details'])
            );
        }
        return new self($array);
    }

    protected function validate($item): void
    {
        if (!$item instanceof TransactionHead) {
            throw new InvalidArgumentException('TransactionHeadCollection must be TransactionHead type.');
        }
    }
}
