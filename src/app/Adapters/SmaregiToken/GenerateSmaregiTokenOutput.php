<?php
declare(strict_types=1);

namespace App\Adapters\SmaregiToken;

use Smareco\Shared\Models\ValueObjects\TokenResponse;
use Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken\GenerateSmaregiTokenOutputPort;

class GenerateSmaregiTokenOutput implements GenerateSmaregiTokenOutputPort
{
    private TokenResponse $tokenResponse;

    public function output(TokenResponse $tokenResponse): void
    {
        $this->tokenResponse = $tokenResponse;
    }

    public function tokenResponse(): TokenResponse
    {
        return $this->tokenResponse;
    }
}
