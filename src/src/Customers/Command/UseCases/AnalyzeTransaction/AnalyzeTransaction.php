<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\AnalyzeTransaction;

use Smareco\Customers\Models\Services\AIServiceInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Throwable;

class AnalyzeTransaction implements AnalyzeTransactionInterface
{
    /**
     * @var AIServiceInterface
     */
    private AIServiceInterface $AIService;

    /**
     * AnalyzeTransaction constructor.
     *
     * @param AIServiceInterface $AIService
     */
    public function __construct(AIServiceInterface $AIService)
    {
        $this->AIService = $AIService;
    }

    /**
     * @param AnalyzeTransactionInputPort $inputPort
     * @param AnalyzeTransactionOutputPort $outputPort
     * @throws SmarecoSpecificationException
     */
    public function process(AnalyzeTransactionInputPort $inputPort, AnalyzeTransactionOutputPort $outputPort): void
    {
        try {
            $this->AIService->setApiKey($inputPort->apiKey());
            $postEndpoint = $this->AIService->getPostEndpoint();
            $this->AIService->uploadCsv($postEndpoint, $inputPort->csvPath());
            $this->AIService->setNotificationURL($inputPort->notificationUrl());
            $this->AIService->analyze();
        } catch (Throwable $e) {
            throw new SmarecoSpecificationException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
