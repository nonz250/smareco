<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\GetCustomersRequest;
use App\Http\Session\SmaregiUserInfoSession;
use Illuminate\Http\JsonResponse;
use Smareco\Customers\Query\GetCustomerQuery;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Throwable;

class GetCustomersAction extends Controller
{
    /**
     * @var GetCustomerQuery
     */
    private GetCustomerQuery $getCustomerQuery;
    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * GetCustomersAction constructor.
     *
     * @param GetCustomerQuery $getCustomerQuery
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(
        GetCustomerQuery $getCustomerQuery,
        SmaregiUserInfoSession $smaregiUserInfoSession
    ) {
        $this->getCustomerQuery = $getCustomerQuery;
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetCustomersRequest $request
     * @throws Throwable
     * @throws SmarecoSpecificationExceptionInterface
     * @return JsonResponse
     */
    public function __invoke(GetCustomersRequest $request)
    {
        try {
            $customers = $this->getCustomerQuery->findForPaginate(
                (string) config('smareco.providers.smaregi'),
                [$this->smaregiUserInfoSession->getSmaregiUserInfo()->contractId()],
                (string) $request->get('name', '') ?? '',
                (string) $request->get('store_id', '') ?? '',
                (int) $request->get('length', 100) ?? 100,
                (string) $request->get('order', 'asc') ?? 'asc',
                (string) $request->get('order_key', 'name') ?? 'name',
            );
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json($customers);
    }
}
