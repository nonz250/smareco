<?php
declare(strict_types=1);

namespace Smareco\Shared\Traits;

use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Entities\SyncHistory;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;
use Throwable;

trait SyncHistoryTrait
{
    /**
     * @var SyncHistoryFactoryInterface
     */
    private SyncHistoryFactoryInterface $syncHistoryFactory;

    /**
     * @var SyncHistoryRepositoryInterface
     */
    private SyncHistoryRepositoryInterface $syncHistoryRepository;

    /**
     * @var SyncNecessaryRepositoryInterface
     */
    private SyncNecessaryRepositoryInterface $syncNecessaryRepository;

    /**
     * SyncHistoryTrait constructor.
     *
     * @param SyncHistoryFactoryInterface $syncHistoryFactory
     * @param SyncHistoryRepositoryInterface $syncHistoryRepository
     * @param SyncNecessaryRepositoryInterface $syncNecessaryRepository
     */
    public function __construct(
        SyncHistoryFactoryInterface $syncHistoryFactory,
        SyncHistoryRepositoryInterface $syncHistoryRepository,
        SyncNecessaryRepositoryInterface $syncNecessaryRepository
    ) {
        $this->syncHistoryFactory = $syncHistoryFactory;
        $this->syncHistoryRepository = $syncHistoryRepository;
        $this->syncNecessaryRepository = $syncNecessaryRepository;
    }

    /**
     * @param string $providerId
     * @param string $contractId
     * @param Target $target
     * @throws SmarecoSpecificationExceptionInterface
     * @return SyncHistory
     */
    public function registerSyncHistory(string $providerId, string $contractId, Target $target)
    {
        $syncHistory = $this->syncHistoryFactory->newSyncHistory(
            $providerId,
            $contractId,
            $target
        );

        $this->syncHistoryRepository->save($syncHistory);

        $syncNecessary = $this->syncNecessaryRepository->find(
            $providerId,
            $contractId,
            $target
        );

        if ($syncNecessary) {
            try {
                $this->syncNecessaryRepository->delete($syncNecessary);
            } catch (Throwable $e) {
                throw new SmarecoSpecificationException(
                    $e->getMessage(),
                    $e->getCode(),
                    $e
                );
            }
        }

        return $syncHistory;
    }
}
