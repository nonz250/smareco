<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\Notification;

use App\Adapters\AIProcessHistory\DownloadAnalyzedCsv\DownloadAnalyzedCsvOuput;
use App\Adapters\AIProcessHistory\SaveAIProcessHistory\SaveAIProcessHistoryOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Notification\AINotificationRequest;
use Illuminate\Http\JsonResponse;
use Psr\Log\LoggerInterface;
use Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory\SaveAIProcessHistoryInterface;
use Smareco\Customers\Command\UseCases\DownloadAnalyzedCsv\DownloadAnalyzedCsvInterface;
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
     * @var DownloadAnalyzedCsvInterface
     */
    private DownloadAnalyzedCsvInterface $downloadAnalyzedCsv;

    /**
     * AINotificationAction constructor.
     *
     * @param LoggerInterface $logger
     * @param SaveAIProcessHistoryInterface $saveAIProcessHistory
     * @param DownloadAnalyzedCsvInterface $downloadAnalyzedCsv
     */
    public function __construct(
        LoggerInterface $logger,
        SaveAIProcessHistoryInterface $saveAIProcessHistory,
        DownloadAnalyzedCsvInterface $downloadAnalyzedCsv
    ) {
        $this->logger = $logger;
        $this->saveAIProcessHistory = $saveAIProcessHistory;
        $this->downloadAnalyzedCsv = $downloadAnalyzedCsv;
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

        $saveAIProcessHistoryResponse = new SaveAIProcessHistoryOutput();
        try {
            $this->saveAIProcessHistory->process($request, $saveAIProcessHistoryResponse);
        } catch (Throwable $e) {
            throw $e;
        }

        if ($request->get('text', '') === 'List creation succeeded.') {
            $this->logger->info('AI演算結果取得開始');
            $response = new DownloadAnalyzedCsvOuput();
            try {
                $this->downloadAnalyzedCsv->process($request, $response);
            } catch (Throwable $e) {
                throw $e;
            }
            $this->logger->info('AI演算結果取得終了');
        }

        return response()->json();
    }
}
