<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class AccessToken
{
    private string $accessToken;

    /**
     * AccessToken constructor.
     *
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->accessToken;
    }
}
