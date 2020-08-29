<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\Collection\ScopeCollection;
use Smareco\Shared\Models\ValueObjects\GrantType;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

interface SmaregiTokenRepositoryInterface
{
    /**
     * @param GrantType $grantType
     * @param ScopeCollection $scopes
     * @param string $contractId
     * @throws SmarecoSpecificationExceptionInterface
     * @return TokenResponse
     */
    public function findToken(GrantType $grantType, ScopeCollection $scopes, string $contractId): TokenResponse;

    /**
     * @param TokenResponse $tokenResponse
     * @throws SmarecoSpecificationExceptionInterface
     * @return TokenResponse
     */
    public function saveSmaregiTokenToSession(TokenResponse $tokenResponse): TokenResponse;
}
