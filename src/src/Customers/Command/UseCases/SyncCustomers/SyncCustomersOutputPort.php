<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

use Smareco\Shared\Models\Entities\SyncHistory;

interface SyncCustomersOutputPort
{
    /**
     * @param SyncHistory $syncHistory
     */
    public function output(SyncHistory $syncHistory): void;
}
