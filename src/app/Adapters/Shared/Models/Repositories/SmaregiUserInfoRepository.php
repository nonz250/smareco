<?php
declare(strict_types=1);

namespace App\Adapters\Shared\Models\Repositories;

use App\Http\Session\SmaregiUserInfoSession;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Smareco\Exceptions\SmarecoSpecificationException;
use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;
use Smareco\Shared\Models\ValueObjects\AccessToken;
use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;

class SmaregiUserInfoRepository implements SmaregiUserInfoRepositoryInterface
{
    /** @var string */
    private const USER_INFO_PATH = '/userinfo';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * SmaregiUserInfoRepository constructor.
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

    /**
     * @param string $tokenType
     * @param AccessToken $accessToken
     * @throws SmarecoSpecificationExceptionInterface
     * @return SmaregiUserInfo
     */
    public function findUserInfoFromApi(string $tokenType, AccessToken $accessToken): SmaregiUserInfo
    {
        $headers = [
            'Authorization' => $tokenType . ' ' . (string) $accessToken,
        ];

        $request = new Request('POST', config('smareco.smaregi_api_host.idp') . self::USER_INFO_PATH, $headers);

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new SmarecoSpecificationException('スマレジユーザー情報を取得できませんでした。', $e->getCode(), $e);
        }

        if ($response->getStatusCode() >= 400) {
            throw new SmarecoSpecificationException($response->getBody()->getContents(), $response->getStatusCode());
        }

        $responseBody = json_decode($response->getBody()->getContents());

        return new SmaregiUserInfo(
            (string) $responseBody->sub,
            (string) $responseBody->contract->id,
            (bool) $responseBody->contract->is_owner,
        );
    }

    /**
     * @return SmaregiUserInfo|null
     */
    public function findUserInfoFromSession(): ?SmaregiUserInfo
    {
        return $this->smaregiUserInfoSession->getUserInfo();
    }

    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     * @return SmaregiUserInfo
     */
    public function saveUserInfoToSession(SmaregiUserInfo $smaregiUserInfo): SmaregiUserInfo
    {
        $this->smaregiUserInfoSession->setUserInfo($smaregiUserInfo);
        return $smaregiUserInfo;
    }
}
