<?php
declare(strict_types=1);

namespace App\Http\Session;

use Illuminate\Contracts\Session\Session;

class StateSession
{
    /** @var string */
    private const KEY = 'state';

    /**
     * @var Session
     */
    private Session $session;

    /**
     * StateSession constructor.
     *
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->session->put(self::KEY, $state);
    }

    /**
     * @return string
     */
    public function state(): string
    {
        return $this->session->get(self::KEY, '') ?? '';
    }
}
