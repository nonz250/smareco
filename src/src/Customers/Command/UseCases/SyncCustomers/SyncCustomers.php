<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

class SyncCustomers implements SyncCustomersInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * SyncCustomers constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param SyncCustomersInputPort $inputPort
     * @param SyncCustomersOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SyncCustomersInputPort $inputPort, SyncCustomersOutputPort $outputPort): void
    {
        $page = 1;

        while (true) {
            $customerCollection = $this->customerRepository->findCustomerFromApiForPaginate(
                $inputPort->tokenType(),
                $inputPort->accessToken(),
                $inputPort->contractId(),
                $page
            );

            if ($customerCollection->isEmpty()) {
                break;
            }

            // 永続化処理
            foreach ($customerCollection as $customer) {
                $this->customerRepository->saveToStorage($customer);
            }

            $page++;
        }

        $outputPort->output();
    }
}
