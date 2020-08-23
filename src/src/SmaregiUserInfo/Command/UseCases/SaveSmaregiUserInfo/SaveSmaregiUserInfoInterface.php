<?php
declare(strict_types=1);

namespace Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface SaveSmaregiUserInfoInterface
{
    /**
     * @param SaveSmaregiUserInfoInputPort $inputPort
     * @param SaveSmaregiUserInfoOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SaveSmaregiUserInfoInputPort $inputPort, SaveSmaregiUserInfoOutputPort $outputPort): void;
}
