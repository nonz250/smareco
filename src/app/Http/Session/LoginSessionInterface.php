<?php
declare(strict_types=1);

namespace App\Http\Session;

use DateTimeInterface;
use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

interface LoginSessionInterface
{
    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     */
    public function setSmaregiUserInfo(SmaregiUserInfo $smaregiUserInfo): void;

    /**
     * @return SmaregiUserInfo|null
     */
    public function getSmaregiUserInfo(): ?SmaregiUserInfo;

    /**
     * @param TokenResponse $tokenResponse
     * @return mixed
     */
    public function setSmaregiToken(TokenResponse $tokenResponse): void;

    /**
     * @return TokenResponse|null
     */
    public function getSmaregiToken(): ?TokenResponse;

    /**
     * @return bool
     */
    public function isLoggedIn(): bool;

    /**
     * @param DateTimeInterface $date
     * @return bool
     */
    public function IsExpiredAt(DateTimeInterface $date): bool;
}
