<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo;

interface SaveSmaregiUserInfoInputPort
{
    /**
     * @return string
     */
    public function grantType(): string;

    /**
     * @return string
     */
    public function code(): string;

    /**
     * @return string
     */
    public function redirectUri(): string;
}
