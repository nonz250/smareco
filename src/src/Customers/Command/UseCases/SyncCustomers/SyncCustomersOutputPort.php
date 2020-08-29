<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

interface SyncCustomersOutputPort
{
    public function output(): void;
}
