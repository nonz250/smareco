<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo;

interface GetSmaregiUserInfoInterface
{
    /**
     * @param GetSmaregiUserInfoInputPort $inputPort
     * @param GetSmaregiUserInfoOutputPort $outputPort
     */
    public function process(GetSmaregiUserInfoInputPort $inputPort, GetSmaregiUserInfoOutputPort $outputPort): void;
}
