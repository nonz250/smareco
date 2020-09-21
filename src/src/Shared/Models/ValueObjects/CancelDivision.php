<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

use Smareco\Foundation\Enum;

class CancelDivision extends Enum
{
    public const DIVISION_NORMAL = 0;
    public const DIVISION_CANCEL = 1;
}
