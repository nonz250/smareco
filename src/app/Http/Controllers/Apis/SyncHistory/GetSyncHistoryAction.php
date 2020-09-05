<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\SyncHistory;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncHistory\SyncHistoryRequest;
use App\Http\Session\SmaregiUserInfoSession;
use App\Traits\GetProviderTrait;
use App\Traits\GetSmaregiUserInfoTrait;
use Illuminate\Http\JsonResponse;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Queries\GetSyncHistoryQuery;
use Throwable;

class GetSyncHistoryAction extends Controller
{
    use GetSmaregiUserInfoTrait, GetProviderTrait;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * @var GetSyncHistoryQuery
     */
    private GetSyncHistoryQuery $getSyncHistoryQuery;

    /**
     * GetSyncHistoryAction constructor.
     *
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     * @param GetSyncHistoryQuery $getSyncHistoryQuery
     */
    public function __construct(
        SmaregiUserInfoSession $smaregiUserInfoSession,
        GetSyncHistoryQuery $getSyncHistoryQuery
    ) {
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
        $this->getSyncHistoryQuery = $getSyncHistoryQuery;
    }

    /**
     * Handle the incoming request.
     *
     * @param SyncHistoryRequest $request
     * @throws Throwable
     * @throws SmarecoSpecificationExceptionInterface
     * @return JsonResponse
     */
    public function __invoke(SyncHistoryRequest $request)
    {
        try {
            $syncHistory = $this->getSyncHistoryQuery->findLatest(
                $this->getProviderId(),
                $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId()
            );
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json($syncHistory ? $syncHistory->toArray() : []);
    }
}
