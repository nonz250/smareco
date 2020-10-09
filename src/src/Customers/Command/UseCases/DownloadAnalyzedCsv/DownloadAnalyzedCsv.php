<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv;

use Smareco\Customers\Models\Services\AIServiceInterface;
use Smareco\Customers\Models\Services\TransactionServiceInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Throwable;

class DownloadAnalyzedCsv implements DownloadAnalyzedCsvInterface
{
    /**
     * @var AIServiceInterface
     */
    private AIServiceInterface $AIService;

    /**
     * @var TransactionServiceInterface
     */
    private TransactionServiceInterface $transactionService;

    /**
     * DownloadAnalyzedCsv constructor.
     *
     * @param AIServiceInterface $AIService
     * @param TransactionServiceInterface $transactionService
     */
    public function __construct(
        AIServiceInterface $AIService,
        TransactionServiceInterface $transactionService
    ) {
        $this->AIService = $AIService;
        $this->transactionService = $transactionService;
    }

    /**
     * @param DownloadAnalyzedCsvInputPort $inputPort
     * @param DownloadAnalyzedCsvOutputPort $outputPort
     * @throws SmarecoSpecificationException
     */
    public function process(DownloadAnalyzedCsvInputPort $inputPort, DownloadAnalyzedCsvOutputPort $outputPort): void
    {
        $this->AIService->setApiKey($inputPort->apiKey());
        $resultEndpoint = $this->AIService->getResultEndpoint();
        $csv = $this->AIService->result($resultEndpoint);
        try {
            $resultPath = $this->transactionService->CreateAnalyzedCsv($inputPort->contractId(), $csv);
        } catch (Throwable $e) {
            throw new SmarecoSpecificationException($e->getMessage(), 500, $e);
        }
        $outputPort->output($resultPath);
    }
}
