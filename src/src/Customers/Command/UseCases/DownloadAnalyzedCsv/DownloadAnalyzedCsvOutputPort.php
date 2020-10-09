<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv;

interface DownloadAnalyzedCsvOutputPort
{
    public function output(string $path): void;

    public function path(): string;
}
