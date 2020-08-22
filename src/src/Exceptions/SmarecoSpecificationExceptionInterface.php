<?php
declare(strict_types=1);

namespace Smareco\Exceptions;

use Throwable;

interface SmarecoSpecificationExceptionInterface extends Throwable
{
    /**
     * MissionSpecificationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 500, Throwable $previous = null);
}
