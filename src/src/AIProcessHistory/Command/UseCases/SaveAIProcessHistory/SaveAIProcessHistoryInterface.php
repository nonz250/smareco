<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory;

interface SaveAIProcessHistoryInterface
{
    public function process(SaveAIProcessHistoryInputPort $inputPort, SaveAIProcessHistoryOutputPort $outputPort): void;
}
