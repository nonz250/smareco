<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CustomerStatus extends Enum
{
    private const STATUS_ENABLED = 0;
    private const STATUS_DISABLED = 1;
    private const STATUS_NOTFOUND = 2;
    private const STATUS_WITHDRAWAL = 3;
    private const STATUS_NAME_IDENTIFICATION = 4;
}
