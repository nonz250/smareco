<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\SyncCustomerRequest;
use Illuminate\Http\JsonResponse;

class SyncCustomerAction extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param SyncCustomerRequest $request
     * @return JsonResponse
     */
    public function __invoke(SyncCustomerRequest $request)
    {
        return response()->json([], 204);
    }
}
