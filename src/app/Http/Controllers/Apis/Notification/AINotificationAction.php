<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Notification;

use App\Adapters\AIProcessHistory\SaveAIProcessHistory\SaveAIProcessHistoryOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\AINotificationRequest;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;
use Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory\SaveAIProcessHistoryInterface;
use Throwable;

class AINotificationAction extends Controller
{
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;
    /**
     * @var SaveAIProcessHistoryInterface
     */
    private SaveAIProcessHistoryInterface $saveAIProcessHistory;

    /**
     * AINotificationAction constructor.
     *
     * @param LoggerInterface $logger
     * @param SaveAIProcessHistoryInterface $saveAIProcessHistory
     */
    public function __construct(
        LoggerInterface $logger,
        SaveAIProcessHistoryInterface $saveAIProcessHistory
    ) {
        $this->logger = $logger;
        $this->saveAIProcessHistory = $saveAIProcessHistory;
    }

    /**
     * Handle the incoming request.
     *
     * @param AINotificationRequest $request
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(AINotificationRequest $request)
    {
        $contractId = $request->get('contract_id');
        $this->logger->info('AI演算終了');
        $this->logger->info(sprintf('契約ID：[%s]', $contractId));
        $this->logger->info($request);

        $response = new SaveAIProcessHistoryOutput();
        try {
            $this->saveAIProcessHistory->process($request, $response);
        } catch (Throwable $e) {
            throw $e;
        }

        return response()->json();
    }
}
