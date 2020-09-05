<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\SmaregiWebhook;

use App\Adapters\SmaregiWebhook\SmaregiWebhookOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\SmaregiWebhook\SmaregiWebhookRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\SmaregiWebhook\SmaregiWebhookInterface;
use Throwable;

class SmaregiWebhookAction extends Controller
{
    /**
     * @var SmaregiWebhookInterface
     */
    private SmaregiWebhookInterface $smaregiWebhookUseCase;

    /**
     * SmaregiWebhookAction constructor.
     *
     * @param SmaregiWebhookInterface $smaregiWebhookUseCase
     */
    public function __construct(SmaregiWebhookInterface $smaregiWebhookUseCase)
    {
        $this->smaregiWebhookUseCase = $smaregiWebhookUseCase;
    }

    /**
     * Handle the incoming request.
     *
     * @param SmaregiWebhookRequest $request
     * @throws SmarecoSpecificationExceptionInterface
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(SmaregiWebhookRequest $request)
    {
        $response = new SmaregiWebhookOutput();
        DB::beginTransaction();
        try {
            $this->smaregiWebhookUseCase->process($request, $response);
            DB::commit();
        } catch (SmarecoSpecificationExceptionInterface $e) {
            DB::rollBack();
            throw $e;
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return response()->json([], 204);
    }
}
