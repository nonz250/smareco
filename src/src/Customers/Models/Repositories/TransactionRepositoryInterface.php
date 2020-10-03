<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Repositories;

use Smareco\Customers\Models\Collection\TransactionDetailCollection;
use Smareco\Customers\Models\Collection\TransactionHeadCollection;
use Smareco\Customers\Models\Entities\TransactionHead;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\ValueObjects\AccessToken;

interface TransactionRepositoryInterface
{
    /**
     * @param string $customerCode
     * @param string $tokenType
     * @param AccessToken $accessToken
     * @param string $contractId
     * @param int $page
     * @param int $length
     * @throws SmarecoSpecificationExceptionInterface
     * @return TransactionHeadCollection
     */
    public function findTransactionByCustomerCodeFromApi(
        string $customerCode,
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): TransactionHeadCollection;

    /**
     * @param TransactionHead $transactionHead
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function save(TransactionHead $transactionHead): void;

    public function findDetailByContractId(string $contractId): TransactionHeadCollection;
}
