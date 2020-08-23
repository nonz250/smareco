<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class ClientSecret
{
    private string $clientSecret;

    /**
     * ClientSecret constructor.
     *
     * @param string $clientSecret
     */
    public function __construct(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->clientSecret;
    }
}
