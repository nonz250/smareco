<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Models\ValueObject;

use Smareco\Foundation\Enum;

class ProcessStatus extends Enum
{
    public const STATUS_END_PROCESS = 1;
}
