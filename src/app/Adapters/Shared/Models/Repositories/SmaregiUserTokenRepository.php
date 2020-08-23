<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserTokenRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\Code;
use Smareco\Shared\Models\ValueObjects\GrantType;
use Smareco\Shared\Models\ValueObjects\RedirectUri;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

class SmaregiUserTokenRepository implements SmaregiUserTokenRepositoryInterface
{
    /** @var string */
    private const TOKEN_PATH = '/authorize/token';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * SmaregiUserTokenRepository constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param GrantType $grantType
     * @param Code $code
     * @param RedirectUri $redirectUri
     * @throws SmarecoSpecificationExceptionInterface
     * @return TokenResponse
     */
    public function findFromApi(GrantType $grantType, Code $code, RedirectUri $redirectUri): TokenResponse
    {
        $headers = [
            'Authorization' => 'Basic ' . base64_encode(config('smareco.client_id') . ':' . config('smareco.client_secret')),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = http_build_query([
            'grant_type' => (string) $grantType,
            'code' => (string) $code,
            'redirect_uri' => (string) $redirectUri,
        ]);

        $request = new Request('POST', config('smareco.smaregi_api_host.idp') . self::TOKEN_PATH, $headers, $body);

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('トークンの取得に失敗しました。', 500, $e);
        }

        if ($response->getStatusCode() >= 400) {
            throw new SmarecoSpecificationException($response->getBody()->getContents(), $response->getStatusCode());
        }

        return TokenResponse::fromArray((array) json_decode($response->getBody()->getContents()));
    }
}
