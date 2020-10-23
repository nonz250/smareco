<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncTransaction;

use DateTimeInterface;
use Smareco\Shared\Models\ValueObjects\AccessToken;

interface SyncTransactionInputPort
{
    /**
     * @return string
     */
    public function providerId(): string;

    /**
     * @return string
     */
    public function tokenType(): string;

    /**
     * @return AccessToken
     */
    public function accessToken(): AccessToken;

    /**
     * @return string
     */
    public function contractId(): string;

    public function from(): DateTimeInterface;

    public function to(): DateTimeInterface;
}
