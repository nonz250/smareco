<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class RedirectUri
{
    private string $redirectUri;

    /**
     * RedirectUri constructor.
     *
     * @param string $redirectUri
     */
    public function __construct(string $redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->redirectUri;
    }
}
