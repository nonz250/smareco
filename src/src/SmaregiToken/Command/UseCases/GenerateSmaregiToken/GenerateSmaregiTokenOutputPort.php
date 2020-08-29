<?php
declare(strict_types=1);

namespace Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken;

use Smareco\Shared\Models\ValueObjects\TokenResponse;

interface GenerateSmaregiTokenOutputPort
{
    /**
     * @param TokenResponse $tokenResponse
     */
    public function output(TokenResponse $tokenResponse): void;
}
