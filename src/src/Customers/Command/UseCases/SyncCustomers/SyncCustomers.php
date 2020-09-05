<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;

class SyncCustomers implements SyncCustomersInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private CustomerRepositoryInterface $customerRepository;

    /**
     * @var SyncHistoryFactoryInterface
     */
    private SyncHistoryFactoryInterface $syncHistoryFactory;

    /**
     * @var SyncHistoryRepositoryInterface
     */
    private SyncHistoryRepositoryInterface $syncHistoryRepository;

    /**
     * SyncCustomers constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param SyncHistoryFactoryInterface $syncHistoryFactory
     * @param SyncHistoryRepositoryInterface $syncHistoryRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SyncHistoryFactoryInterface $syncHistoryFactory,
        SyncHistoryRepositoryInterface $syncHistoryRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->syncHistoryFactory = $syncHistoryFactory;
        $this->syncHistoryRepository = $syncHistoryRepository;
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

        $syncHistory = $this->syncHistoryFactory->newSyncHistory(
            $inputPort->providerId(),
            $inputPort->contractId(),
            new Target(Target::TARGET_CUSTOMER)
        );

        $this->syncHistoryRepository->save($syncHistory);

        $outputPort->output($syncHistory);
    }
}
