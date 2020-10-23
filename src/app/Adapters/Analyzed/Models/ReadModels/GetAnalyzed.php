<?php
declare(strict_types=1);

namespace App\Adapters\Analyzed\Models\ReadModels;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Smareco\Analyzed\Query\GetAnalyzedQuery;

class GetAnalyzed implements GetAnalyzedQuery
{
    /**
     * @var Customer
     */
    private Customer $customer;

    /**
     * @var Product
     */
    private Product $product;

    /**
     * GetAnalyzed constructor.
     *
     * @param Customer $customer
     * @param Product $product
     */
    public function __construct(
        Customer $customer,
        Product $product
    ) {
        $this->customer = $customer;
        $this->product = $product;
    }

    public function findLatestByContractId(string $providerId, string $contractId)
    {
        $files = Storage::files('csv/' . $contractId . '/result');
        $latestPath = storage_path('app/' . Arr::last(Arr::sort($files)));
        $handle = fopen($latestPath, 'r');
        if ($handle === false) {
            throw new RuntimeException('演算結果CSVを読み込めませんでした。');
        }

        $result = [];
        while (($data = fgetcsv($handle, 1000, ',', '"')) !== false) {
            $ret = [];
            $customerId = $data[0];
            $customer = $this->customer->newQuery()
                ->where('provider_id', $providerId)
                ->where('contract_id', $contractId)
                ->where('customer_id', $customerId)
                ->first();
            $ret['customer'] = $customer->toArray();
            $rows = explode(',', $data[1]);
            foreach ($rows as $row) {
                $fields = explode(':', $row);
                $productId = $fields[0] ?? '';
                $num = $fields[1] ?? '';
                $product = null;
                if ($productId) {
                    $product = $this->product->newQuery()
                        ->where('provider_id', $providerId)
                        ->where('contract_id', $contractId)
                        ->where('product_id', $productId)
                        ->first();
                }
                if (!$product) {
                    $ret['data'] = [];
                    continue;
                }
                $ret['data'][] = [
                    'product' => $product->toArray(),
                    'num' => $num,
                ];
            }
            $result[] = $ret;
        }
        return $result;
    }
}
