<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use Smareco\Foundation\Enum;

class TaxDivision extends Enum
{
    public const DIVISION_INCLUDE_TAX = 0;
    public const DIVISION_EXCLUDE_TAX = 1;
    public const DIVISION_NONE_TAX = 2;
}
