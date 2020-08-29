<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

use Smareco\Shared\Models\ValueObjects\AccessToken;

interface SyncCustomersInputPort
{
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
}
