<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class ClientId
{
    private string $clientId;

    /**
     * ClientId constructor.
     *
     * @param string $clientId
     */
    public function __construct(string $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->clientId;
    }
}
