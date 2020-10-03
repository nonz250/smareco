<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv;

use Smareco\Customers\Models\Repositories\TransactionRepositoryInterface;
use Smareco\Customers\Models\Services\TransactionServiceInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Throwable;

class CreateProductPurchaseCsv implements CreateProductPurchaseCsvInterface
{
    /**
     * @var TransactionRepositoryInterface
     */
    private TransactionRepositoryInterface $transactionRepository;

    /**
     * @var TransactionServiceInterface
     */
    private TransactionServiceInterface $transactionService;

    /**
     * CreateProductPurchaseCsv constructor.
     *
     * @param TransactionRepositoryInterface $transactionRepository
     * @param TransactionServiceInterface $transactionService
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        TransactionServiceInterface $transactionService
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->transactionService = $transactionService;
    }

    /**
     * @param CreateProductPurchaseCsvInputPort $inputPort
     * @param CreateProductPurchaseCsvOutputPort $outputPort
     * @throws SmarecoSpecificationException
     */
    public function process(
        CreateProductPurchaseCsvInputPort $inputPort,
        CreateProductPurchaseCsvOutputPort $outputPort
    ): void {
        $transactionDetailCollection = $this->transactionRepository->findDetailByContractId($inputPort->contractId());
        try {
            $path = $this->transactionService->CreateProductPurchaseCsv(
                $inputPort->contractId(),
                $transactionDetailCollection
            );
        } catch (Throwable $e) {
            throw new SmarecoSpecificationException($e->getMessage(), 500, $e);
        }
        $outputPort->output($path);
    }
}
