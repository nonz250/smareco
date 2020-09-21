<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Collection;

use DateTime;
use InvalidArgumentException;
use Smareco\Customers\Models\Entities\Customer;
use Smareco\Customers\Models\ValueObjects\CustomerMailReceiveFlag;
use Smareco\Customers\Models\ValueObjects\CustomerSex;
use Smareco\Customers\Models\ValueObjects\CustomerStatus;
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
                (string) $item['providerId'],
                (string) $item['contractId'],
                (string) $item['customerId'],
                (string) $item['customerCode'],
                (string) $item['rank'],
                (string) ($item['lastName'] . ' ' . $item['firstName']),
                (string) ($item['lastKana'] . ' ' . $item['firstKana']),
                (string) ($item['mailAddress'] ?? $item['mailAddress2'] ?? $item['mailAddress3']),
                (string) ($item['mobileNumber'] ?? $item['phoneNumber'] ?? $item['faxNumber']),
                new CustomerSex((int) $item['sex']),
                $item['birthDate'] ? DateTime::createFromFormat('Y-m-d', $item['birthDate']) : null,
                $item['entryDate'] ? DateTime::createFromFormat('Y-m-d', $item['entryDate']) : null,
                $item['leaveDate'] ? DateTime::createFromFormat('Y-m-d', $item['leaveDate']) : null,
                $item['lastComeDateTime'] ? DateTime::createFromFormat('Y-m-d\TH:i:sP', $item['lastComeDateTime']) : null,
                (string) $item['storeId'],
                new CustomerMailReceiveFlag((int) $item['mailReceiveFlag']),
                new CustomerStatus((int) $item['status']),
            );
        }
        return new self($array);
    }

    public static function fromStorage(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new Customer(
                (string) $item['id'],
                (string) $item['provider_id'],
                (string) $item['contract_id'],
                (string) $item['customer_id'],
                (string) $item['customer_code'],
                (string) $item['rank'],
                (string) $item['name'],
                (string) $item['kana'],
                (string) $item['email'],
                (string) $item['phone'],
                new CustomerSex((int) $item['sex']),
                $item['birthday'] ? DateTime::createFromFormat('Y-m-d H:i:s', $item['birthday']) : null,
                $item['entry_date'] ? DateTime::createFromFormat('Y-m-d H:i:s', $item['entry_date']) : null,
                $item['leave_date'] ? DateTime::createFromFormat('Y-m-d H:i:s', $item['leave_date']) : null,
                $item['last_coming_datetime'] ? DateTime::createFromFormat('Y-m-d H:i:s', $item['last_coming_datetime']) : null,
                (string) $item['store_id'],
                new CustomerMailReceiveFlag((int) $item['mail_receive_flag']),
                new CustomerStatus((int) $item['status']),
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
