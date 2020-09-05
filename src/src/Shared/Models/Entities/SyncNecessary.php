<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Entities;

use Smareco\Shared\Models\ValueObjects\Target;

class SyncNecessary
{
    private string $id;
    private string $providerId;
    private string $contractId;
    private Target $target;
    private string $field;

    /**
     * SyncNecessary constructor.
     *
     * @param string $id
     * @param string $providerId
     * @param string $contractId
     * @param Target $target
     * @param string $field
     */
    public function __construct(
        string $id,
        string $providerId,
        string $contractId,
        Target $target,
        string $field
    ) {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->contractId = $contractId;
        $this->target = $target;
        $this->field = $field;
    }

    /**
     * @return Target
     */
    public function target(): Target
    {
        return $this->target;
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->contractId;
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
    public function providerId(): string
    {
        return $this->providerId;
    }

    /**
     * @return string
     */
    public function field(): string
    {
        return $this->field;
    }

    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'provider_id' => (string) $this->providerId,
            'contract_id' => (string) $this->contractId,
            'target' => (string) $this->target,
            'field' => (string) $this->field,
        ];
    }
}
