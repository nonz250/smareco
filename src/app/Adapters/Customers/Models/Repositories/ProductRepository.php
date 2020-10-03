<?php
declare(strict_types=1);

namespace App\Adapters\Customers\Models\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Str;
use RuntimeException;
use Smareco\Customers\Models\Collection\ProductCollection;
use Smareco\Customers\Models\Entities\Product;
use Smareco\Customers\Models\Repositories\ProductRepositoryInterface;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Shared\Models\ValueObjects\AccessToken;

class ProductRepository implements ProductRepositoryInterface
{
    private const PRODUCT_PATH = '/products';

    /**
     * @var Client
     */
    private Client $client;
    private \App\Models\Product $product;

    /**
     * ProductRepository constructor.
     *
     * @param Client $client
     * @param \App\Models\Product $product
     */
    public function __construct(Client $client, \App\Models\Product $product)
    {
        $this->client = $client;
        $this->product = $product;
    }

    /**
     * @param string $tokenType
     * @param AccessToken $accessToken
     * @param string $contractId
     * @param int $page
     * @param int $length
     * @throws SmarecoSpecificationException
     * @return ProductCollection
     */
    public function findProductFromApiForPaginate(
        string $tokenType,
        AccessToken $accessToken,
        string $contractId,
        int $page,
        int $length = 1000
    ): ProductCollection {
        $headers = [
            'Authorization' => $tokenType . ' ' . (string) $accessToken,
        ];

        $query = http_build_query([
            'page' => (int) $page,
            'limit' => (int) $length,
        ]);

        $request = new Request(
            'GET',
            config('smareco.smaregi_api_host.pos') . '/' . $contractId . '/pos' . self::PRODUCT_PATH . '?' . $query,
            $headers
        );

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('商品情報を取得できませんでした。', $e->getCode(), $e);
        }

        $responseBody = json_decode($response->getBody()->getContents(), true);

        foreach ($responseBody as $key => $item) {
            $responseBody[$key]['id'] = (string) Str::uuid();
            $responseBody[$key]['providerId'] = (string) config('smareco.providers.smaregi');
            $responseBody[$key]['contractId'] = (string) $contractId;
        }
        return ProductCollection::fromArray($responseBody);
    }

    public function saveToStorage(Product $product): void
    {
        $productModel = $this->product->newQuery()
            ->firstOrNew([
                'provider_id' => $product->providerId(),
                'contract_id' => $product->contractId(),
                'product_id' => $product->productId(),
            ])->fill([
                'category_id' => $product->categoryId(),
                'code' => $product->code(),
                'name' => $product->name(),
                'kana' => $product->kana(),
                'tax_division' => $product->taxDivision()->toInt(),
                'price' => $product->price(),
                'customer_price' => $product->customerPrice(),
                'cost' => $product->cost(),
                'description' => $product->description(),
            ]);

        if (!$productModel->getAttribute('id')) {
            $productModel->setAttribute('id', $product->id());
        }

        if (!$productModel->save()) {
            throw new RuntimeException('商品情報の保存に失敗しました。');
        }
    }
}
