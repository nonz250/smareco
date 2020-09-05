<?php
declare(strict_types=1);

namespace Smareco\SmaregiWebhook;

interface SmaregiWebhookOutputPort
{
    public function output(): void;
}
