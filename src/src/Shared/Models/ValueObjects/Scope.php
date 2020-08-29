<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class Scope
{
    private string $scope;

    /**
     * Scope constructor.
     *
     * @param string $scope
     */
    public function __construct(string $scope)
    {
        $this->scope = $scope;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->scope;
    }
}
