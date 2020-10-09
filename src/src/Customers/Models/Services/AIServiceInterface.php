<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Services;

interface AIServiceInterface
{
    public function setApiKey(string $apiKey): void;

    public function setNotificationURL(string $url);

    public function getPostEndpoint(): string;

    public function uploadCsv(string $postEndpoint, string $csvPath): void;

    public function analyze(): void;

    public function getAnalyzeStatus(): string;

    public function getResultEndpoint(): string;

    public function result(string $resultEndpoint): string;
}
