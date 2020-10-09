<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv;

interface DownloadAnalyzedCsvInputPort
{
    public function apiKey(): string;

    public function contractId(): string;
}
