<?php
declare(strict_types=1);

namespace Smareco\Customers\Query;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface GetCustomerQuery
{
    /**
     * @param string $providerId
     * @param array $contractIds
     * @param string $name
     * @param string $storeId
     * @param int $length
     * @param string $order
     * @param string $orderKey
     * @throws SmarecoSpecificationExceptionInterface
     * @return array
     */
    public function findForPaginate(
        string $providerId = '',
        array $contractIds = [],
        string $name = '',
        string $storeId = '',
        int $length = 100,
        string $order = 'asc',
        string $orderKey = 'name'
    ): array;
}
