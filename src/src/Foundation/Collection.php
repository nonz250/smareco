<?php
declare(strict_types=1);

namespace Smareco\Foundation;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate, Countable
{
    protected array $items;

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    abstract public function __construct(array $items = []);

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @param array $items
     */
    abstract public static function fromArray(array $items);

    /**
     * @param mixed $item
     */
    abstract protected function validate($item): void;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
