<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Collection;

use InvalidArgumentException;
use Smareco\Foundation\Collection;
use Smareco\Shared\Models\ValueObjects\Scope;

class ScopeCollection extends Collection
{
    public function __construct(array $items = [])
    {
        foreach ($items as $item) {
            $this->validate($item);
        }
        $this->items = $items;
    }

    public function __toString(): string
    {
        return implode(' ', $this->toArray());
    }

    public function toArray(): array
    {
        $array = [];
        /** @var Scope $item */
        foreach ($this->items as $item) {
            $array[] = (string) $item;
        }
        return $array;
    }

    public static function fromArray(array $items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = new Scope((string) $item);
        }
        return new self($array);
    }

    protected function validate($item): void
    {
        if (!$item instanceof Scope) {
            throw new InvalidArgumentException('ScopeCollection item must be Scope type.');
        }
    }
}
