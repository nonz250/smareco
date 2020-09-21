<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncTransaction;

use Smareco\Shared\Models\Entities\SyncHistory;

interface SyncTransactionOutputPort
{
    /**
     * @param SyncHistory $syncHistory
     */
    public function output(SyncHistory $syncHistory): void;
}
