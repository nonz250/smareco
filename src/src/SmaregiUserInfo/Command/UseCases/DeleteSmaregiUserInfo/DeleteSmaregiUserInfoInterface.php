<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo;

interface DeleteSmaregiUserInfoInterface
{
    /**
     * @param DeleteSmaregiUserInfoInputPort $inputPort
     * @param DeleteSmaregiUserInfoOutputPort $outputPort
     */
    public function process(DeleteSmaregiUserInfoInputPort $inputPort, DeleteSmaregiUserInfoOutputPort $outputPort): void;
}
