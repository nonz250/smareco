<?php
declare(strict_types=1);

namespace Smareco\Shared\Models\Repositories;

use Smareco\Exceptions\SmarecoSpecificationExceptionInterface;
use Smareco\Shared\Models\ValueObjects\Code;
use Smareco\Shared\Models\ValueObjects\GrantType;
use Smareco\Shared\Models\ValueObjects\RedirectUri;
use Smareco\Shared\Models\ValueObjects\TokenResponse;

interface SmaregiUserTokenRepositoryInterface
{
    /**
     * @param GrantType $grantType
     * @param Code $code
     * @param RedirectUri $redirectUri
     * @throws SmarecoSpecificationExceptionInterface
     * @return TokenResponse
     */
    public function findFromApi(GrantType $grantType, Code $code, RedirectUri $redirectUri): TokenResponse;
}
