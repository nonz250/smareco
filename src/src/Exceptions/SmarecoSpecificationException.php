<?php
declare(strict_types=1);

namespace Smareco\Exceptions;

use Exception;
use Throwable;

class SmarecoSpecificationException extends Exception implements SmarecoSpecificationExceptionInterface
{
    /**
     * MissionSpecificationException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
