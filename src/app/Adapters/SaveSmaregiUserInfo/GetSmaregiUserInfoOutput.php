<?php
declare(strict_types=1);

namespace App\Adapters\SaveSmaregiUserInfo;

use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo\GetSmaregiUserInfoOutputPort;

class GetSmaregiUserInfoOutput implements GetSmaregiUserInfoOutputPort
{
    /**
     * @var SmaregiUserInfo
     */
    private SmaregiUserInfo $smaregiUserInfo;

    public function output(SmaregiUserInfo $smaregiUserInfo): void
    {
        $this->smaregiUserInfo = $smaregiUserInfo;
    }

    /**
     * @return SmaregiUserInfo
     */
    public function smaregiUserInfo(): SmaregiUserInfo
    {
        return $this->smaregiUserInfo;
    }
}
