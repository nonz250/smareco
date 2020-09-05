<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\SyncNecessary;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncNecessary\GetSyncNecessaryRequest;
use App\Http\Session\SmaregiUserInfoSession;
use App\Traits\GetProviderTrait;
use App\Traits\GetSmaregiUserInfoTrait;
use Illuminate\Http\JsonResponse;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Queries\GetSyncNecessaryQuery;
use Throwable;

class GetSyncNecessaryAction extends Controller
{
    use GetSmaregiUserInfoTrait, GetProviderTrait;

    /**
     * @var GetSyncNecessaryQuery
     */
    private GetSyncNecessaryQuery $getSyncNecessaryQuery;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * GetSyncNecessaryAction constructor.
     *
     * @param GetSyncNecessaryQuery $getSyncNecessaryQuery
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(
        GetSyncNecessaryQuery $getSyncNecessaryQuery,
        SmaregiUserInfoSession $smaregiUserInfoSession
    ) {
        $this->getSyncNecessaryQuery = $getSyncNecessaryQuery;
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    /**
     * Handle the incoming request.
     *
     * @param GetSyncNecessaryRequest $request
     * @throws SmarecoSpecificationExceptionInterface
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(GetSyncNecessaryRequest $request)
    {
        try {
            $syncNecessary = $this->getSyncNecessaryQuery->findLatest(
                $this->getProviderId(),
                $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId()
            );
        } catch (SmarecoSpecificationExceptionInterface $e) {
            throw $e;
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json($syncNecessary ? $syncNecessary->toArray() : []);
    }
}
