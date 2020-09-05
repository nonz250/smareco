<?php
declare(strict_types=1);

namespace App\Traits;

trait GetProviderTrait
{
    use GetSmaregiUserInfoTrait;

    public function getProviderId()
    {
        $providerId = '';
        if ($this->getSmaregiUserInfoSession()) {
            $providerId = config('smareco.providers.smaregi');
        }
        return $providerId;
    }
}
