<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Entities;

use DateTimeInterface;
use Smareco\Shared\Models\ValueObjects\Target;

class SyncHistory
{
    private string $id;
    private string $providerId;
    private string $contractId;
    private Target $target;
    private DateTimeInterface $syncDatetime;

    /**
     * SyncHistory constructor.
     *
     * @param string $id
     * @param string $providerId
     * @param string $contractId
     * @param Target $target
     * @param DateTimeInterface $syncDatetime
     */
    public function __construct(
        string $id,
        string $providerId,
        string $contractId,
        Target $target,
        DateTimeInterface $syncDatetime
    ) {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->contractId = $contractId;
        $this->target = $target;
        $this->syncDatetime = $syncDatetime;
    }

    /**
     * @return string
     */
    public function providerId(): string
    {
        return $this->providerId;
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
    public function syncDatetime(): DateTimeInterface
    {
        return $this->syncDatetime;
    }

    /**
     * @return Target
     */
    public function target(): Target
    {
        return $this->target;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'provider_id' => (string) $this->providerId,
            'contract_id' => (string) $this->contractId,
            'target' => (string) $this->target,
            'sync_datetime' => $this->syncDatetime->format('Y/m/d H:i:s'),
        ];
    }
}
