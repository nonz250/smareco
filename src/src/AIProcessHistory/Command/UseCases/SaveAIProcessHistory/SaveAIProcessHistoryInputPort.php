<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory;

interface SaveAIProcessHistoryInputPort
{
    public function contractId(): string;

    public function processName(): string;

    public function processText(): string;
}
