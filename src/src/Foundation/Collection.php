<?php
declare(strict_types=1);

namespace Smareco\Foundation;

use ArrayIterator;
use Countable;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate, Countable
{
    protected $items;

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

    abstract protected function validate(): void;

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }
}
