<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv;

interface DownloadAnalyzedCsvInterface
{
    public function process(DownloadAnalyzedCsvInputPort $inputPort, DownloadAnalyzedCsvOutputPort $outputPort): void;
}
