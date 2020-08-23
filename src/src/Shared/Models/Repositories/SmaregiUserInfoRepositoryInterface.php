<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\ValueObjects\AccessToken;
use Smareco\Shared\Models\ValueObjects\SmaregiUserInfo;

interface SmaregiUserInfoRepositoryInterface
{
    /**
     * @param string $tokenType
     * @param AccessToken $accessToken
     * @throws SmarecoSpecificationExceptionInterface
     * @return SmaregiUserInfo
     */
    public function findUserInfoFromApi(string $tokenType, AccessToken $accessToken): SmaregiUserInfo;

    /**
     * @return SmaregiUserInfo|null
     */
    public function findUserInfoFromSession(): ?SmaregiUserInfo;

    /**
     * @param SmaregiUserInfo $smaregiUserInfo
     * @return SmaregiUserInfo
     */
    public function saveUserInfoToSession(SmaregiUserInfo $smaregiUserInfo): SmaregiUserInfo;
}
