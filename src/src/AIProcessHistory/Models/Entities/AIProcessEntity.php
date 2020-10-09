<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Models\Entities;

use DateTimeInterface;
use Smareco\AIProcessHistory\Models\ValueObject\ProcessStatus;

class AIProcessEntity
{
    private string $id;
    private string $contractId;
    /**
     * @var ProcessStatus
     */
    private ProcessStatus $processStatus;
    private DateTimeInterface $notificationDatetime;

    /**
     * AIProcessEntity constructor.
     *
     * @param string $id
     * @param string $contractId
     * @param ProcessStatus $processStatus
     * @param DateTimeInterface $notificationDatetime
     */
    public function __construct(string $id, string $contractId, ProcessStatus $processStatus, DateTimeInterface $notificationDatetime)
    {
        $this->id = $id;
        $this->contractId = $contractId;
        $this->processStatus = $processStatus;
        $this->notificationDatetime = $notificationDatetime;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->contractId;
    }

    /**
     * @return DateTimeInterface
     */
    public function notificationDatetime(): DateTimeInterface
    {
        return $this->notificationDatetime;
    }

    /**
     * @return ProcessStatus
     */
    public function processStatus(): ProcessStatus
    {
        return $this->processStatus;
    }

    /**
     * @param ProcessStatus $processStatus
     */
    public function setProcessStatus(ProcessStatus $processStatus): void
    {
        $this->processStatus = $processStatus;
    }

    /**
     * @param DateTimeInterface $notificationDatetime
     */
    public function setNotificationDatetime(DateTimeInterface $notificationDatetime): void
    {
        $this->notificationDatetime = $notificationDatetime;
    }
}
