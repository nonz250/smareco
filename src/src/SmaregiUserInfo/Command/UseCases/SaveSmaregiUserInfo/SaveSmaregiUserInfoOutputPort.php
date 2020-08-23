<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo;

use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;

interface SaveSmaregiUserInfoOutputPort
{
    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     */
    public function output(SmaregiUserInfo $smaregiUserInfo): void;
}
