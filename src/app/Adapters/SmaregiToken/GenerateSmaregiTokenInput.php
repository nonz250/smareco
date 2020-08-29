<?php
declare(strict_types=1);

namespace App\Adapters\SmaregiToken;

use App\Traits\GetSmaregiUserInfoTrait;
use Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken\GenerateSmaregiTokenInputPort;

class GenerateSmaregiTokenInput implements GenerateSmaregiTokenInputPort
{
    use GetSmaregiUserInfoTrait;

    public function grantType(): string
    {
        return (string) 'client_credentials';
    }

    public function scopes(): array
    {
        return config('smareco.scopes');
    }

    public function contractId(): string
    {
        return $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId();
    }
}
