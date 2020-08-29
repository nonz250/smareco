<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Repositories;

use App\Http\Session\SmaregiUserInfoSession;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Shared\Models\Collection\ScopeCollection;
use Smareco\Shared\Models\Repositories\SmaregiTokenRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\GrantType;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

class SmaregiTokenRepository implements SmaregiTokenRepositoryInterface
{
    private const TOKEN_PATH = '/token';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * SmaregiTokenRepository constructor.
     *
     * @param Client $client
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(
        Client $client,
        SmaregiUserInfoSession $smaregiUserInfoSession
    ) {
        $this->client = $client;
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    public function findToken(GrantType $grantType, ScopeCollection $scopes, string $contractId): TokenResponse
    {
        $headers = [
            'Authorization' => 'Basic ' . base64_encode(config('smareco.client_id') . ':' . config('smareco.client_secret')),
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $body = http_build_query([
            'grant_type' => (string) $grantType,
            'scope' => (string) $scopes,
        ]);

        $request = new Request(
            'POST',
            config('smareco.smaregi_api_host.idp') . '/app/' . $contractId . self::TOKEN_PATH,
            $headers,
            $body
        );

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('トークンの取得に失敗しました。', 500, $e);
        }

        return TokenResponse::fromArray((array) json_decode($response->getBody()->getContents()));
    }

    public function saveSmaregiTokenToSession(TokenResponse $tokenResponse): TokenResponse
    {
        $this->smaregiUserInfoSession->setSmaregiToken($tokenResponse);
        return $tokenResponse;
    }
}
