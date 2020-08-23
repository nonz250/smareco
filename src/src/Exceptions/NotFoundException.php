<?php
declare(strict_types=1);

namespace Smareco\Exceptions;

use Throwable;

class NotFoundException extends SmarecoSpecificationException implements SmarecoSpecificationExceptionInterface
{
    /**
     * NotFoundException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
