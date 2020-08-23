<?php
declare(strict_types=1);

namespace Smareco\Exceptions;

use Throwable;

class MisdirectedException extends SmarecoSpecificationException implements SmarecoSpecificationExceptionInterface
{
    /**
     * MisdirectedException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 421, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
