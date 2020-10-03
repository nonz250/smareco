<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\AnalyzeTransaction;

interface AnalyzeTransactionInputPort
{
    public function apiKey(): string;

    public function csvPath(): string;

    public function notificationUrl(): string;
}
