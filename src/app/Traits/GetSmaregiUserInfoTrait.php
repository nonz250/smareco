<?php
declare(strict_types=1);

namespace App\Traits;

use App\Http\Session\SmaregiUserInfoSession;

trait GetSmaregiUserInfoTrait
{
    /**
     * @var SmaregiUserInfoSession
     */
    private SmaregiUserInfoSession $smaregiUserInfoSession;

    /**
     * GetSmaregiUserInfoTrait constructor.
     *
     * @param SmaregiUserInfoSession $smaregiUserInfoSession
     */
    public function __construct(SmaregiUserInfoSession $smaregiUserInfoSession)
    {
        $this->smaregiUserInfoSession = $smaregiUserInfoSession;
    }

    /**
     * @return SmaregiUserInfoSession
     */
    public function getSmaregiUserInfoSession(): SmaregiUserInfoSession
    {
        return $this->smaregiUserInfoSession;
    }
}
