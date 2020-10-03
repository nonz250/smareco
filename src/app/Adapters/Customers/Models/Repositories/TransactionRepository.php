<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Smareco\Customers\Models\Collection\TransactionDetailCollection;
use Smareco\Customers\Models\Collection\TransactionHeadCollection;
use Smareco\Customers\Models\Entities\TransactionDetail;
use Smareco\Customers\Models\Entities\TransactionHead;
use Smareco\Customers\Models\Repositories\TransactionRepositoryInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Shared\Models\ValueObjects\AccessToken;

class TransactionRepository implements TransactionRepositoryInterface
{
    private const TRANSACTION_PATH = '/transactions';

    /**
     * @var Client
     */
    private Client $client;
    private \App\Models\TransactionHead $transactionHead;
    private \App\Models\TransactionDetail $transactionDetail;

    /**
     * TransactionRepository constructor.
     *
     * @param Client $client
     * @param \App\Models\TransactionHead $transactionHead
     * @param \App\Models\TransactionDetail $transactionDetail
     */
    public function __construct(
        Client $client,
        \App\Models\TransactionHead $transactionHead,
        \App\Models\TransactionDetail $transactionDetail
    ) {
        $this->client = $client;
        $this->transactionHead = $transactionHead;
        $this->transactionDetail = $transactionDetail;
    }

    public function findTransactionByCustomerCodeFromApi(
        string $customerCode,
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): TransactionHeadCollection {
        $headers = [
            'Authorization' => $tokenType . ' ' . (string) $accessToken,
        ];

        $query = http_build_query([
            'page' => (int) $page,
            'limit' => (int) $length,
            'customer_code' => (string) $customerCode,
        ]);

        $request = new Request(
            'GET',
            config('smareco.smaregi_api_host.pos') . '/' . $contractId . '/pos' . self::TRANSACTION_PATH . '?' . $query,
            $headers
        );

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('スマレジユーザー情報を取得できませんでした。', $e->getCode(), $e);
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);
        foreach ($responseBody as $key => $item) {
            $detailQuery = http_build_query([
                'with_details' => 'all',
            ]);

            $detailRequest = new Request(
                'GET',
                config('smareco.smaregi_api_host.pos') . '/' . $contractId . '/pos' . self::TRANSACTION_PATH . '/' . $item['transactionHeadId'] . '?' . $detailQuery,
                $headers
            );

            try {
                $detailResponse = $this->client->send($detailRequest);
            } catch (GuzzleException $e) {
                throw new SmarecoSpecificationException('スマレジユーザー情報を取得できませんでした。', $e->getCode(), $e);
            }

            $detailResponseBody = json_decode($detailResponse->getBody()->getContents(), true);

            $responseBody[$key]['id'] = (string) Str::uuid();
            $responseBody[$key]['providerId'] = (string) config('smareco.providers.smaregi');
            $responseBody[$key]['contractId'] = (string) $contractId;
            $responseBody[$key]['details'] = $detailResponseBody['details'];
        }
        return TransactionHeadCollection::fromApiArray($responseBody);
    }

    public function save(TransactionHead $transactionHead): void
    {
        $transactionHeadModel = $this->transactionHead->newQuery()
            ->firstOrNew([
                'provider_id' => $transactionHead->providerId(),
                'contract_id' => $transactionHead->contractId(),
                'transaction_head_id' => $transactionHead->transactionHeadId(),
            ])->fill([
                'transaction_datetime' => $transactionHead->transactionDatetime(),
                'cancel_division' => $transactionHead->cancelDivision()->toInt(),
                'total' => $transactionHead->total(),
                'point_discount' => $transactionHead->pointDiscount(),
                'amount' => $transactionHead->amount(),
                'store_id' => $transactionHead->storeId(),
                'customer_id' => $transactionHead->customerId(),
                'customer_code' => $transactionHead->customerCode(),
            ]);

        if (!$transactionHeadModel->getAttribute('id')) {
            $transactionHeadModel->setAttribute('id', $transactionHead->id());
        }

        if (!$transactionHeadModel->save()) {
            throw new SmarecoSpecificationException('取引情報の保存に失敗しました。');
        }

        $transactionDetails = $transactionHead->details();

        $this->transactionDetail->newQuery()
            ->where('transaction_head_id', $transactionHeadModel->getAttribute('id'))
            ->delete();

        /** @var TransactionDetail $transactionDetail */
        foreach ($transactionDetails as $transactionDetail) {
            $result = $this->transactionDetail->newQuery()
                ->firstOrNew([
                    'transaction_head_id' => $transactionHeadModel->getAttribute('id'),
                    'product_id' => $transactionDetail->productId(),
                ])->fill([
                    'provider_transaction_head_id' => $transactionHead->transactionHeadId(),
                    'product_name' => $transactionDetail->productName(),
                    'product_code' => $transactionDetail->productCode(),
                    'price' => $transactionDetail->price(),
                    'quantity' => $transactionDetail->quantity(),
                ])->save();
            if (!$result) {
                throw new SmarecoSpecificationException('取引情報の保存に失敗しました。');
            }
        }
    }

    public function findDetailByContractId(string $contractId): TransactionHeadCollection
    {
        $transactions = $this->transactionHead->newQuery()
            ->with(['transaction_detail'])
            ->where('contract_id', $contractId)
            ->get();
        return TransactionHeadCollection::fromArray($transactions->toArray());
    }
}
