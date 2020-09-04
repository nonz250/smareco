<?php
declare(strict_types=1);

namespace Smareco\Foundation;

use InvalidArgumentException;
use ReflectionObject;

abstract class Enum
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Enum constructor.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $ref = new ReflectionObject($this);
        $constants = $ref->getConstants();
        if (!in_array($value, $constants, true)) {
            throw new InvalidArgumentException(sprintf('This must be %s values.', implode(' or ', $constants)));
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    final public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    final public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * @return int
     */
    final public function toInt(): int
    {
        return (int) $this->value;
    }
}
