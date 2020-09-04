<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CustomerSex extends Enum
{
    private const SEX_UNKNOWN = 0;
    private const SEX_MAN = 1;
    private const SEX_WOMAN = 2;
}
