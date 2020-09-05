<?php
declare(strict_types=1);

namespace Smareco\SmaregiWebhook;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface SmaregiWebhookInterface
{
    /**
     * @param SmaregiWebhookInputPort $inputPort
     * @param SmaregiWebhookOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SmaregiWebhookInputPort $inputPort, SmaregiWebhookOutputPort $outputPort): void;
}
