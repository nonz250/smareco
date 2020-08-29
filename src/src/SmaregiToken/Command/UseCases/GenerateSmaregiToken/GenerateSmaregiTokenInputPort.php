<?php
declare(strict_types=1);

namespace Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken;

interface GenerateSmaregiTokenInputPort
{
    public function grantType(): string;

    public function scopes(): array;

    public function contractId(): string;
}
