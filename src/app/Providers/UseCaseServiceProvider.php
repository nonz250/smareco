<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfoInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaveSmaregiUserInfoInterface::class, SaveSmaregiUserInfo::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
