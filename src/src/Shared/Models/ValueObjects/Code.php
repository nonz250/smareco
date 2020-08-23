<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class Code
{
    private string $code;

    /**
     * Code constructor.
     *
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->code;
    }
}
