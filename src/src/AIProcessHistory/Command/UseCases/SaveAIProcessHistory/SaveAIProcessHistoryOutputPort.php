<?php
declare(strict_types=1);

namespace Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory;

interface SaveAIProcessHistoryOutputPort
{
    public function output(): void;
}
