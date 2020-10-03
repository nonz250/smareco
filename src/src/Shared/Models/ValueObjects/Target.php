<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

use Smareco\Foundation\Enum;

class Target extends Enum
{
    public const TARGET_CUSTOMER = 'customer';
    public const TARGET_TRANSACTION = 'transaction';
    public const TARGET_PRODUCT = 'product';
}
