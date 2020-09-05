<?php
declare(strict_types=1);

namespace Smareco\SmaregiWebhook;

interface SmaregiWebhookInputPort
{
    public function isCustomer(): bool;

    public function event(): string;

    public function providerId(): string;

    public function contractId(): string;

    public function body(): array;
}
