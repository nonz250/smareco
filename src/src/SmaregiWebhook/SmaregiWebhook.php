<?php
declare(strict_types=1);

namespace Smareco\SmaregiWebhook;

use Smareco\Shared\Models\Factories\SyncNecessaryFactoryInterface;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;

class SmaregiWebhook implements SmaregiWebhookInterface
{
    /**
     * @var SyncNecessaryRepositoryInterface
     */
    private SyncNecessaryRepositoryInterface $syncNecessaryRepository;
    /**
     * @var SyncNecessaryFactoryInterface
     */
    private SyncNecessaryFactoryInterface $syncNecessaryFactory;

    /**
     * SmaregiWebhook constructor.
     *
     * @param SyncNecessaryRepositoryInterface $syncNecessaryRepository
     * @param SyncNecessaryFactoryInterface $syncNecessaryFactory
     */
    public function __construct(
        SyncNecessaryRepositoryInterface $syncNecessaryRepository,
        SyncNecessaryFactoryInterface $syncNecessaryFactory
    ) {
        $this->syncNecessaryRepository = $syncNecessaryRepository;
        $this->syncNecessaryFactory = $syncNecessaryFactory;
    }

    public function process(SmaregiWebhookInputPort $inputPort, SmaregiWebhookOutputPort $outputPort): void
    {
        $target = new Target(Target::TARGET_CUSTOMER);
        if ($inputPort->isCustomer()) {
            $target = new Target(Target::TARGET_CUSTOMER);
        } elseif ($inputPort->isTransaction()) {
            $target = new Target(Target::TARGET_TRANSACTION);
        } elseif ($inputPort->isProduct()) {
            $target = new Target(Target::TARGET_PRODUCT);
        }

        $body = json_encode($inputPort->body(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);

        $syncNecessary = $this->syncNecessaryFactory->newSyncNecessary(
            $inputPort->providerId(),
            $inputPort->contractId(),
            $target,
            $body,
        );

        $this->syncNecessaryRepository->save($syncNecessary);

        $outputPort->output();
    }
}
