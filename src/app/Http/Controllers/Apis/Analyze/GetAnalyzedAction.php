<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Analyze;

use App\Http\Controllers\Controller;
use App\Http\Requests\Analyze\GetAnalyzedRequest;
use App\Http\Session\SmaregiUserInfoSession;
use App\Traits\GetSmaregiUserInfoTrait;
use Illuminate\Http\JsonResponse;
use Smareco\Analyzed\Query\GetAnalyzedQuery;
use Throwable;

class GetAnalyzedAction extends Controller
{
    use GetSmaregiUserInfoTrait;

    /**
     * @var GetAnalyzedQuery
     */
    private GetAnalyzedQuery $getAnalyzedQuery;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * GetAnalyzedAction constructor.
     *
     * @param GetAnalyzedQuery $getAnalyzedQuery
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(
        GetAnalyzedQuery $getAnalyzedQuery,
        SmaregiUserInfoSession $smaregiUserInfoSession
    ) {
        $this->getAnalyzedQuery = $getAnalyzedQuery;
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetAnalyzedRequest $request
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(GetAnalyzedRequest $request)
    {
        try {
            $result = $this->getAnalyzedQuery->findLatestByContractId(
                (string)config('smareco.providers.smaregi'),
                $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId()
            );
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json($result);
    }
}
