<?php
declare(strict_types=1);

namespace App\Adapters\SaveSmaregiUserInfo;

use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfoOutputPort;

class SaveSmaregiUserInfoOutput implements SaveSmaregiUserInfoOutputPort
{
    private SmaregiUserInfo $smaregiUserInfo;

    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     */
    public function output(SmaregiUserInfo $smaregiUserInfo): void
    {
        $this->smaregiUserInfo = $smaregiUserInfo;
    }

    /**
     * @return SmaregiUserInfo
     */
    public function smaregUserInfo(): SmaregiUserInfo
    {
        return $this->smaregiUserInfo;
    }
}
