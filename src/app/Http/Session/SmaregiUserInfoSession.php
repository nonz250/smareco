<?php
declare(strict_types=1);

namespace App\Http\Session;

use DateTimeInterface;
use Illuminate\Contracts\Session\Session;
use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

class SmaregiUserInfoSession implements LoginSessionInterface
{
    /** @var string */
    private const KEY = 'smaregi';

    /** @var string */
    private const KEY_USER_INFO = self::KEY . '.user';

    /** @var string */
    private const KEY_TOKEN = self::KEY . '.token';

    /**
     * @var Session
     */
    private Session $session;

    /**
     * SmaregiUserInfoSession constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     */
    public function setSmaregiUserInfo(SmaregiUserInfo $smaregiUserInfo): void
    {
        $this->session->put(self::KEY_USER_INFO, $smaregiUserInfo->toArray());
    }

    /**
     * @return SmaregiUserInfo|null
     */
    public function getSmaregiUserInfo(): ?SmaregiUserInfo
    {
        $smaregiUserInfo = $this->session->get(self::KEY_USER_INFO);
        if (!$smaregiUserInfo) {
            return null;
        }
        return SmaregiUserInfo::fromArray($smaregiUserInfo);
    }

    /**
     * @param TokenResponse $tokenResponse
     */
    public function setSmaregiToken(TokenResponse $tokenResponse): void
    {
        $this->session->put(self::KEY_TOKEN, $tokenResponse->toArray());
    }

    /**
     * @return TokenResponse|null
     */
    public function getSmaregiToken(): ?TokenResponse
    {
        $tokenResponse = $this->session->get(self::KEY_TOKEN);
        if (!$tokenResponse) {
            return null;
        }
        return TokenResponse::fromArray($tokenResponse);
    }

    /**
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->getSmaregiUserInfo() !== null;
    }

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function IsExpiredAt(DateTimeInterface $date): bool
    {
        return $this->getSmaregiToken() !== null;
    }
}
