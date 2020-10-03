<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Customers;

use App\Adapters\Customers\SyncCustomer\SyncCustomerOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SyncCustomerRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomersInterface;
use Smareco\Customers\Command\UseCases\SyncProducts\SyncProductsInterface;
use Smareco\Customers\Command\UseCases\SyncTransaction\SyncTransactionInterface;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Throwable;

class SyncCustomerAction extends Controller
{
    /**
     * @var SyncCustomersInterface
     */
    private SyncCustomersInterface $syncCustomers;

    /**
     * @var SyncTransactionInterface
     */
    private SyncTransactionInterface $syncTransaction;

    /**
     * @var SyncProductsInterface
     */
    private SyncProductsInterface $syncProducts;

    /**
     * SyncCustomerAction constructor.
     *
     * @param SyncCustomersInterface $syncCustomers
     * @param SyncTransactionInterface $syncTransaction
     * @param SyncProductsInterface $syncProducts
     */
    public function __construct(
        SyncCustomersInterface $syncCustomers,
        SyncTransactionInterface $syncTransaction,
        SyncProductsInterface $syncProducts
    ) {
        $this->syncCustomers = $syncCustomers;
        $this->syncTransaction = $syncTransaction;
        $this->syncProducts = $syncProducts;
    }

    /**
     * Handle the incoming request.
     *
     * @param SyncCustomerRequest $request
     * @throws SmarecoSpecificationExceptionInterface
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(SyncCustomerRequest $request)
    {
        $response = new SyncCustomerOutput();
        DB::beginTransaction();
        try {
            $this->syncCustomers->process($request, $response);
            $this->syncTransaction->process($request, $response);
            $this->syncProducts->process($request, $response);
            DB::commit();
        } catch (SmarecoSpecificationExceptionInterface $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json($response->syncHistory()->toArray());
    }
}
