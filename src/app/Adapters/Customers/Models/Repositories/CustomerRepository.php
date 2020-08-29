<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Smareco\Customers\Models\Collection\CustomerCollection;
use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
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
     * CustomerRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
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

        $request = new Request(
            'GET',
            config('smareco.smaregi_api_host.pos') . '/' . $contractId . '/pos' . self::CUSTOMER_PATH,
            $headers
        );

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('スマレジユーザー情報を取得できませんでした。', $e->getCode(), $e);
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);
        return CustomerCollection::fromArray($responseBody);
    }

    public function saveToStorage(CustomerCollection $customerCollection): CustomerCollection
    {
        // TODO: Implement saveToStorage() method.
    }
}
