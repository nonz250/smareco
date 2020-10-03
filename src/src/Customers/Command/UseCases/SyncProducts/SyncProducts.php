<?php
declare(strict_types=1);

namespace Smareco\Customers\Command\UseCases\SyncProducts;

use Smareco\Customers\Models\Entities\Product;
use Smareco\Customers\Models\Repositories\ProductRepositoryInterface;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Target;
use Smareco\Shared\Traits\SyncHistoryTrait;

class SyncProducts implements SyncProductsInterface
{
    use SyncHistoryTrait;

    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

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
     * SyncProduct constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param SyncHistoryFactoryInterface $syncHistoryFactory
     * @param SyncHistoryRepositoryInterface $syncHistoryRepository
     * @param SyncNecessaryRepositoryInterface $syncNecessaryRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SyncHistoryFactoryInterface $syncHistoryFactory,
        SyncHistoryRepositoryInterface $syncHistoryRepository,
        SyncNecessaryRepositoryInterface $syncNecessaryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->syncHistoryFactory = $syncHistoryFactory;
        $this->syncHistoryRepository = $syncHistoryRepository;
        $this->syncNecessaryRepository = $syncNecessaryRepository;
    }

    /**
     * @param SyncProductsInputPort $inputPort
     * @param SyncProductsOutputPort $outputPort
     * @throws SmarecoSpecificationExceptionInterface
     */
    public function process(SyncProductsInputPort $inputPort, SyncProductsOutputPort $outputPort): void
    {
        $page = 1;
        while (true) {
            $productCollection = $this->productRepository->findProductFromApiForPaginate(
                $inputPort->tokenType(),
                $inputPort->accessToken(),
                $inputPort->contractId(),
                $page
            );

            if ($productCollection->isEmpty()) {
                break;
            }

            /** @var Product $product */
            foreach ($productCollection as $product) {
                $this->productRepository->saveToStorage($product);
            }

            $page++;
        }

        $syncHistory = $this->registerSyncHistory(
            $inputPort->providerId(),
            $inputPort->contractId(),
            new Target(Target::TARGET_PRODUCT)
        );

        $outputPort->output($syncHistory);
    }
}
