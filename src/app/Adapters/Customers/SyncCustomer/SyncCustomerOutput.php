<?php
declare(strict_types=1);

namespace App\Adapters\Customers\SyncCustomer;

use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomersOutputPort;
use Smareco\Customers\Command\UseCases\SyncProducts\SyncProductsOutputPort;
use Smareco\Customers\Command\UseCases\SyncTransaction\SyncTransactionOutputPort;
use Smareco\Shared\Models\Entities\SyncHistory;

class SyncCustomerOutput implements SyncCustomersOutputPort, SyncTransactionOutputPort, SyncProductsOutputPort
{
    /**
     * @var SyncHistory
     */
    private SyncHistory $syncHistory;

    /**
     * @param SyncHistory $syncHistory
     */
    public function output(SyncHistory $syncHistory): void
    {
        $this->syncHistory = $syncHistory;
    }

    /**
     * @return SyncHistory
     */
    public function syncHistory(): SyncHistory
    {
        return $this->syncHistory;
    }
}
