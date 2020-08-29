<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncCustomers;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface SyncCustomersInterface
{
    /**
     * @param SyncCustomersInputPort $inputPort
     * @param SyncCustomersOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SyncCustomersInputPort $inputPort, SyncCustomersOutputPort $outputPort): void;
}
