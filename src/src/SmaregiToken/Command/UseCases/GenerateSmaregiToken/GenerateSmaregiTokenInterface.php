<?php
declare(strict_types=1);

namespace Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface GenerateSmaregiTokenInterface
{
    /**
     * @param GenerateSmaregiTokenInputPort $inputPort
     * @param GenerateSmaregiTokenOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(GenerateSmaregiTokenInputPort $inputPort, GenerateSmaregiTokenOutputPort $outputPort): void;
}
