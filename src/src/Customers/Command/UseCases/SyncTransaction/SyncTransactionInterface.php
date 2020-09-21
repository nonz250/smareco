<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncTransaction;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;

interface SyncTransactionInterface
{
    /**
     * @param SyncTransactionInputPort $inputPort
     * @param SyncTransactionOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SyncTransactionInputPort $inputPort, SyncTransactionOutputPort $outputPort): void;
}
