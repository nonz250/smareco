<?php
declare(strict_types=1);

namespace App\Http\Controllers\Apis\AnalyzeTransaction;

use App\Adapters\Customers\AnalyzeTransaction\AnalyzeTransactionOutput;
use App\Adapters\Customers\CreateProductPurchaseCsv\CreateProductPurchaseCsvOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyzeTransaction\AnalyzeTransactionRequest;
use Illuminate\Http\JsonResponse;
use Smareco\Customers\Command\UseCases\AnalyzeTransaction\AnalyzeTransactionInterface;
use Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv\CreateProductPurchaseCsvInterface;
use Throwable;

class AnalyzeTransactionAction extends Controller
{
    /**
     * @var CreateProductPurchaseCsvInterface
     */
    private CreateProductPurchaseCsvInterface $createProductPurchaseCsv;

    /**
     * @var AnalyzeTransactionInterface
     */
    private AnalyzeTransactionInterface $analyzeTransaction;

    /**
     * AnalyzeTransactionAction constructor.
     *
     * @param CreateProductPurchaseCsvInterface $createProductPurchaseCsv
     * @param AnalyzeTransactionInterface $analyzeTransaction
     */
    public function __construct(
        CreateProductPurchaseCsvInterface $createProductPurchaseCsv,
        AnalyzeTransactionInterface $analyzeTransaction
    ) {
        $this->createProductPurchaseCsv = $createProductPurchaseCsv;
        $this->analyzeTransaction = $analyzeTransaction;
    }

    /**
     * Handle the incoming request.
     *
     * @param AnalyzeTransactionRequest $request
     * @throws Throwable
     * @return JsonResponse
     */
    public function __invoke(AnalyzeTransactionRequest $request)
    {
        $createCsvOutput = new CreateProductPurchaseCsvOutput();
        $analyzeOutput = new AnalyzeTransactionOutput();
        try {
            $this->createProductPurchaseCsv->process($request, $createCsvOutput);
            $request->setCsvPath($createCsvOutput->csvPath());
            $this->analyzeTransaction->process($request, $analyzeOutput);
        } catch (Throwable $e) {
            throw $e;
        }
        return response()->json([], 204);
    }
}
