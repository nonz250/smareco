<?php
declare(strict_types=1);

namespace App\Adapters\AIProcessHistory\DownloadAnalyzedCsv;

use Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv\DownloadAnalyzedCsvOutputPort;

class DownloadAnalyzedCsvOuput implements DownloadAnalyzedCsvOutputPort
{
    private string $path;

    public function output(string $path): void
    {
        $this->path = $path;
    }

    public function path(): string
    {
        return $this->path;
    }
}
