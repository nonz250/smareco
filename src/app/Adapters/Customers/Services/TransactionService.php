<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Smareco\Customers\Models\Collection\TransactionHeadCollection;
use Smareco\Customers\Models\Entities\TransactionDetail;
use Smareco\Customers\Models\Entities\TransactionHead;
use Smareco\Customers\Models\Services\TransactionServiceInterface;

class TransactionService implements TransactionServiceInterface
{
    public function CreateProductPurchaseCsv(
        string $contractId,
        TransactionHeadCollection $transactionHeadCollection
    ): string {
        $records = [];

        // １行目はフィールド名を挿入
        $record = [
            'user_id',
            'item_id',
            'time_stamp',
        ];
        $records[] = implode(',', $record);

        // ２行目以降を作成
        /** @var TransactionHead $transaction */
        foreach ($transactionHeadCollection as $transaction) {
            $details = $transaction->details();
            /** @var TransactionDetail $detail */
            foreach ($details as $detail) {
                for ($i = 0; $i < $detail->quantity(); $i++) {
                    $record = [
                        $transaction->customerId(),
                        $detail->productId(),
                        $transaction->transactionDatetime()->format('Y-m-d H:i:s'),
                    ];
                    $records[] = implode(',', $record);
                }
            }
        }
        $content = implode("\n", $records);

        // ファイルを作成
        $filename = Carbon::now()->format('YmdHis') . '.csv';
        $filePath = 'csv/' . $contractId . '/seed/' . $filename;
        if (!Storage::put($filePath, $content, 'private')) {
            throw new RuntimeException('CSVの作成に失敗しました。');
        }

        return $filePath;
    }

    public function CreateAnalyzedCsv(string $contractId, string $csv): string
    {
        $records = [];
//        foreach ($transactionHeadCollection as $transaction) {
//            $details = $transaction->details();
//            /** @var TransactionDetail $detail */
//            foreach ($details as $detail) {
//                for ($i = 0; $i < $detail->quantity(); $i++) {
//                    $record = [
//                        $transaction->customerId(),
//                        $detail->productId(),
//                        $transaction->transactionDatetime()->format('Y-m-d H:i:s'),
//                    ];
//                    $records[] = implode(',', $record);
//                }
//            }
//        }
        $content = implode("\n", $records);

        // ファイルを作成
        $filename = Carbon::now()->format('YmdHis') . '.csv';
        $filePath = 'csv/' . $contractId . '/result/' . $filename;
        if (!Storage::put($filePath, $content, 'private')) {
            throw new RuntimeException('CSVの作成に失敗しました。');
        }

        return $filePath;
    }
}
