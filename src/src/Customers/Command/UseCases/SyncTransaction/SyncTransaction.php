<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncTransaction;

use Smareco\Customers\Models\Entities\Customer;
use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Customers\Models\Repositories\TransactionRepositoryInterface;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;
use Smareco\Shared\Traits\SyncHistoryTrait;

class SyncTransaction implements SyncTransactionInterface
{
    use SyncHistoryTrait;

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
     * @var SyncNecessaryRepositoryInterface
     */
    private SyncNecessaryRepositoryInterface $syncNecessaryRepository;

    /**
     * @var TransactionRepositoryInterface
     */
    private TransactionRepositoryInterface $transactionRepository;

    /**
     * SyncTransaction constructor.
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param SyncHistoryFactoryInterface $syncHistoryFactory
     * @param SyncHistoryRepositoryInterface $syncHistoryRepository
     * @param SyncNecessaryRepositoryInterface $syncNecessaryRepository
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SyncHistoryFactoryInterface $syncHistoryFactory,
        SyncHistoryRepositoryInterface $syncHistoryRepository,
        SyncNecessaryRepositoryInterface $syncNecessaryRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->syncHistoryFactory = $syncHistoryFactory;
        $this->syncHistoryRepository = $syncHistoryRepository;
        $this->syncNecessaryRepository = $syncNecessaryRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function process(
        SyncTransactionInputPort $inputPort,
        SyncTransactionOutputPort $outputPort
    ): void {
        $customerCollection = $this->customerRepository->findByContractId(
            $inputPort->providerId(),
            $inputPort->contractId()
        );

        /** @var Customer $customer */
        foreach ($customerCollection as $customer) {
            $page = 1;
            while (true) {
                $transactionCollection = $this->transactionRepository->findTransactionByCustomerCodeFromApi(
                    $customer->code(),
                    $inputPort->tokenType(),
                    $inputPort->accessToken(),
                    $inputPort->contractId(),
                    $page,
                    $inputPort->from(),
                    $inputPort->to(),
                );
                if ($transactionCollection->isEmpty()) {
                    break;
                }
                foreach ($transactionCollection as $transaction) {
                    $this->transactionRepository->save($transaction);
                }
                $page++;
            }
        }

        $syncHistory = $this->registerSyncHistory(
            $inputPort->providerId(),
            $inputPort->contractId(),
            new Target(Target::TARGET_TRANSACTION)
        );

        $outputPort->output($syncHistory);
    }
}
