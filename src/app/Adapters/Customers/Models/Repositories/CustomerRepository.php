<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use RuntimeException;
use Smareco\Customers\Models\Collection\CustomerCollection;
use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Customers\Models\Entities\Customer;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Shared\Models\ValueObjects\AccessToken;

class CustomerRepository implements CustomerRepositoryInterface
{
    /** @var string */
    private const CUSTOMER_PATH = '/customers';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var \App\Models\Customer
     */
    private \App\Models\Customer $customer;

    /**
     * CustomerRepository constructor.
     *
     * @param Client $client
     * @param \App\Models\Customer $customer
     */
    public function __construct(Client $client, \App\Models\Customer $customer)
    {
        $this->client = $client;
        $this->customer = $customer;
    }

    public function findCustomerFromApiForPaginate(
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): ?CustomerCollection {
        $headers = [
            'Authorization' => $tokenType . ' ' . (string) $accessToken,
        ];

        $query = http_build_query([
            'page' => (int) $page,
            'limit' => (int) $length,
        ]);

        $request = new Request(
            'GET',
            config('smareco.smaregi_api_host.pos') . '/' . $contractId . '/pos' . self::CUSTOMER_PATH . '?' . $query,
            $headers
        );

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('スマレジユーザー情報を取得できませんでした。', $e->getCode(), $e);
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);
        foreach ($responseBody as $key => $item) {
            $responseBody[$key]['id'] = (string) Str::uuid();
            $responseBody[$key]['providerId'] = (string) config('smareco.providers.smaregi');
            $responseBody[$key]['contractId'] = (string) $contractId;
        }
        return CustomerCollection::fromArray($responseBody);
    }

    public function saveToStorage(Customer $customer): Customer
    {
        $customerModel = $this->customer->newQuery()
            ->firstOrNew([
                'provider_id' => $customer->providerId(),
                'contract_id' => $customer->contractId(),
                'customer_id' => $customer->customerId(),
            ])->fill([
                'id' => $customer->id(),
                'customer_code' => $customer->code(),
                'store_id' => $customer->storeId(),
                'rank' => $customer->rank(),
                'name' => $customer->name(),
                'kana' => $customer->kana(),
                'email' => $customer->email(),
                'sex' => $customer->sex()->toInt(),
                'mail_receive_flag' => $customer->mailReceiveFlag()->toInt(),
                'status' => $customer->customerStatus()->toInt(),
            ]);

        if (!$customerModel->save()) {
            throw new RuntimeException('会員情報の保存に失敗しました。');
        }

        return $customer;
    }
}
