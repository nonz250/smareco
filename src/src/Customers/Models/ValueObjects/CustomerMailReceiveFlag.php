<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CustomerMailReceiveFlag extends Enum
{
    private const DISABLED = 0;
    private const ENABLE = 1;
}
