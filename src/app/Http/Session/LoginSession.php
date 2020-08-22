<?php
declare(strict_types=1);

namespace App\Http\Session;

use DateTimeInterface;
use Illuminate\Contracts\Session\Session;

class LoginSession
{
    /** @var string */
    private const KEY = 'smaregi.auth';

    /**
     * @var Session
     */
    private Session $session;

    /**
     * LoginSession constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $tokenType
     * @param DateTimeInterface $expiresIn
     * @param string $accessToken
     * @param string $refreshToken
     * @param string $scope
     * @param string $idToken
     */
    public function setSmaregiAuth(
        string $tokenType,
        DateTimeInterface $expiresIn,
        string $accessToken,
        string $refreshToken,
        string $scope,
        string $idToken
    ): void {
        $this->session->put(self::KEY, [
            'token_type' => $tokenType,
            'expires_in' => $expiresIn->format('Y/m/d H:i:s'),
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'scope' => $scope,
            'id_token' => $idToken,
        ]);
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return count($this->session->get(self::KEY, [])) > 0;
    }

    public function IsExpiredAt(DateTimeInterface $date)
    {
    }
}
