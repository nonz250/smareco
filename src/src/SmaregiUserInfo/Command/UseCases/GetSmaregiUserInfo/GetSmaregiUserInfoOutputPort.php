<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo;

use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;

interface GetSmaregiUserInfoOutputPort
{
    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     */
    public function output(SmaregiUserInfo $smaregiUserInfo): void;
}
