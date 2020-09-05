<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\ReadModels;

use App\Models\Customer;
use Smareco\Customers\Query\GetCustomerQuery;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

class GetCustomer implements GetCustomerQuery
{
    /**
     * @var Customer
     */
    private Customer $customer;

    /**
     * GetCustomer constructor.
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function findForPaginate(
        string $providerId = '',
        array $contractIds = [],
        string $name = '',
        string $storeId = '',
        int $length = 100,
        string $order = 'asc',
        string $orderKey = 'name'
    ): array {
        $query = $this->customer->newQuery();
        if ($providerId) {
            $query = $query->where('provider_id', $providerId);
        }
        if (count($contractIds)) {
            $query = $query->whereIn('contract_id', $contractIds);
        }
        if ($name) {
            $query = $query->where('name', 'LIKE', "%{$name}%");
        }
        $query = $query->orderBy($orderKey, $order);
        $paginate = $query->paginate($length);
        return (array) [
            'items' => $paginate->items(),
            'total' => $paginate->total(),
            'current_page' => $paginate->currentPage(),
            'last_page' => $paginate->lastPage(),
        ];
    }
}
