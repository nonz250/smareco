<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\ValueObjects;

class TokenResponse
{
    private string $tokenType;
    private int $expiresIn;
    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;
    private string $refreshToken;
    private string $scope;
    private ?string $idToken;

    /**
     * TokenResponse constructor.
     *
     * @param string $tokenType
     * @param int $expiresIn
     * @param AccessToken $accessToken
     * @param string $refreshToken
     * @param string $scope
     * @param string|null $idToken
     */
    public function __construct(
        string $tokenType,
        int $expiresIn,
        AccessToken $accessToken,
        string $refreshToken,
        string $scope,
        ?string $idToken = null
    ) {
        $this->tokenType = $tokenType;
        $this->expiresIn = $expiresIn;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->scope = $scope;
        $this->idToken = $idToken;
    }

    /**
     * @return string
     */
    public function tokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @return AccessToken
     */
    public function accessToken(): AccessToken
    {
        return $this->accessToken;
    }

    /**
     * @param array $item
     * @return TokenResponse
     */
    public static function fromArray(array $item): self
    {
        return new self(
            $item['token_type'],
            $item['expires_in'],
            new AccessToken($item['access_token']),
            $item['refresh_token'] ?? '',
            $item['scope'],
            $item['id_token'] ?? null
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'token_type' => $this->tokenType,
            'expires_in' => $this->expiresIn,
            'access_token' => (string) $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'scope' => $this->scope,
            'id_token' => $this->idToken,
        ];
    }
}
