<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory;

use DateTime;
use LogicException;
use Smareco\AIProcessHistory\Models\Factories\AIProcessFactoryInterface;
use Smareco\AIProcessHistory\Models\Repositories\AIProcessRepositoryInterface;
use Smareco\AIProcessHistory\Models\ValueObject\ProcessStatus;

class SaveAIProcessHistory implements SaveAIProcessHistoryInterface
{
    /**
     * @var AIProcessFactoryInterface
     */
    private AIProcessFactoryInterface $AIProcessFactory;

    /**
     * @var AIProcessRepositoryInterface
     */
    private AIProcessRepositoryInterface $AIProcessRepository;

    /**
     * SaveAIProcessHistory constructor.
     *
     * @param AIProcessFactoryInterface $AIProcessFactory
     * @param AIProcessRepositoryInterface $AIProcessRepository
     */
    public function __construct(
        AIProcessFactoryInterface $AIProcessFactory,
        AIProcessRepositoryInterface $AIProcessRepository
    ) {
        $this->AIProcessFactory = $AIProcessFactory;
        $this->AIProcessRepository = $AIProcessRepository;
    }

    public function process(SaveAIProcessHistoryInputPort $inputPort, SaveAIProcessHistoryOutputPort $outputPort): void
    {
        try {
            $aiProcess = $this->AIProcessRepository->findByContractId($inputPort->contractId());
            $aiProcess->setNotificationDatetime(new DateTime());
        } catch (LogicException $e) {
            $aiProcess = $this->AIProcessFactory->newEntity($inputPort->contractId());
        }
        $aiProcess->setProcessStatus(new ProcessStatus(ProcessStatus::STATUS_END_PROCESS));
        $this->AIProcessRepository->save($aiProcess);
    }
}
