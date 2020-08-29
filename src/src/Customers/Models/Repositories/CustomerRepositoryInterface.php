<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Repositories;

use Smareco\Customers\Models\Collection\CustomerCollection;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\ValueObjects\AccessToken;

interface CustomerRepositoryInterface
{
    /**
     * @param string $tokenType
     * @param AccessToken $accessToken
     * @param string $contractId
     * @param int $page
     * @param int $length
     * @throws SmarecoSpecificationExceptionInterface
     * @return CustomerCollection|null
     */
    public function findCustomerFromApiForPaginate(
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): ?CustomerCollection;

    /**
     * @param CustomerCollection $customerCollection
     * @return CustomerCollection
     */
    public function saveToStorage(CustomerCollection $customerCollection): CustomerCollection;
}
