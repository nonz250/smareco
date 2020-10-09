<?php
declare(strict_types=1);

namespace App\Adapters\AIProcessHistory\Models\Repositories;

use App\Models\AIProcessHistory;
use DateTime;
use LogicException;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Smareco\AIProcessHistory\Models\Entities\AIProcessEntity;
use Smareco\AIProcessHistory\Models\Repositories\AIProcessRepositoryInterface;
use Smareco\AIProcessHistory\Models\ValueObject\ProcessStatus;
use Throwable;

class AIProcessRepository implements AIProcessRepositoryInterface
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @var AIProcessHistory
     */
    private AIProcessHistory $AIProcessHistory;

    /**
     * AIProcessRepository constructor.
     *
     * @param LoggerInterface $logger
     * @param AIProcessHistory $AIProcessHistory
     */
    public function __construct(
        LoggerInterface $logger,
        AIProcessHistory $AIProcessHistory
    ) {
        $this->logger = $logger;
        $this->AIProcessHistory = $AIProcessHistory;
    }

    public function findByContractId(string $contractId): AIProcessEntity
    {
        $aiProcessHistory = $this->AIProcessHistory->newQuery()
            ->where('contract_id', $contractId)
            ->first();
        if (!$aiProcessHistory instanceof AIProcessHistory) {
            throw new LogicException('AIProcessHistory is not exist.');
        }
        return new AIProcessEntity(
            (string)$aiProcessHistory->getAttribute('id'),
            (string)$aiProcessHistory->getAttribute('contract_id'),
            new ProcessStatus((int)$aiProcessHistory->getAttribute('status')),
            DateTime::createFromFormat('Y-m-d H:i:s', (string)$aiProcessHistory->getAttribute('notification_datetime')),
        );
    }

    public function save(AIProcessEntity $AIProcessEntity): void
    {
        try {
            $result = $this->AIProcessHistory->newQuery()
                ->firstOrNew([
                    'id' => $AIProcessEntity->id(),
                ])->fill([
                    'contract_id' => $AIProcessEntity->contractId(),
                    'status' => $AIProcessEntity->processStatus()->toInt(),
                    'notification_datetime' => $AIProcessEntity->notificationDatetime(),
                ])->save();
            if ($result === false) {
                throw new RuntimeException('AI処理履歴を保存できませんでした。');
            }
        } catch (Throwable $e) {
            $this->logger->error($e);
            throw new RuntimeException('AI処理履歴を保存できませんでした。');
        }
    }
}
