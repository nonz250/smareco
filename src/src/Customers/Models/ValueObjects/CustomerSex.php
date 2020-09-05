<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CustomerSex extends Enum
{
    public const SEX_UNKNOWN = 0;
    public const SEX_MAN = 1;
    public const SEX_WOMAN = 2;
}
