<?php
declare(strict_types=1);

namespace App\Http\Session;

use DateTimeInterface;
use Illuminate\Contracts\Session\Session;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

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
     * @param TokenResponse $tokenResponse
     */
    public function setSmaregiAuth(TokenResponse $tokenResponse): void
    {
        $this->session->put(self::KEY, $tokenResponse->toArray());
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
