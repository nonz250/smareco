<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\AnalyzeTransaction;

interface AnalyzeTransactionInterface
{
    public function process(AnalyzeTransactionInputPort $inputPort, AnalyzeTransactionOutputPort $outputPort): void;
}
