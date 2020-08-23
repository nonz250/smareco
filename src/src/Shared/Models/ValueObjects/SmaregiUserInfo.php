<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class SmaregiUserInfo
{
    private string $sub;
    private string $contractId;
    private bool $isOwner;

    /**
     * SmaregiUserInfo constructor.
     *
     * @param string $sub
     * @param string $contractId
     * @param bool $isOwner
     */
    public function __construct(string $sub, string $contractId, bool $isOwner)
    {
        $this->sub = $sub;
        $this->contractId = $contractId;
        $this->isOwner = $isOwner;
    }

    /**
     * @return string
     */
    public function sub(): string
    {
        return $this->sub;
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->contractId;
    }

    /**
     * @return bool
     */
    public function isOwner(): bool
    {
        return $this->isOwner;
    }

    /**
     * @param array $item
     * @return static
     */
    public static function fromArray(array $item): self
    {
        return new self(
            (string) $item['sub'],
            (string) $item['contract_id'],
            (bool) $item['is_owner'],
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'sub' => $this->sub(),
            'contract_id' => $this->contractId(),
            'is_owner' => $this->isOwner(),
        ];
    }
}
