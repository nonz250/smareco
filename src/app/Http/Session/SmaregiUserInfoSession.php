<?php
declare(strict_types=1);

namespace App\Http\Session;

use Illuminate\Contracts\Session\Session;
use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;

class SmaregiUserInfoSession
{
    /** @var string */
    private const KEY = 'smaregi.userinfo';

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
    public function setUserInfo(SmaregiUserInfo $smaregiUserInfo): void
    {
        $this->session->put(self::KEY, $smaregiUserInfo->toArray());
    }

    /**
     * @return SmaregiUserInfo|null
     */
    public function getUserInfo(): ?SmaregiUserInfo
    {
        $smaregiUserInfo = $this->session->get(self::KEY);
        if (!$smaregiUserInfo) {
            return null;
        }
        return SmaregiUserInfo::from;
    }
}
