<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CustomerMailReceiveFlag extends Enum
{
    public const DISABLED = 0;
    public const ENABLE = 1;
}
