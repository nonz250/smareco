<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class GrantType
{
    private string $grantType;

    /**
     * GrantType constructor.
     *
     * @param string $grantType
     */
    public function __construct(string $grantType)
    {
        $this->grantType = $grantType;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->grantType;
    }
}
