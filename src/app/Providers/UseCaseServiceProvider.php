<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo\DeleteSmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo\DeleteSmaregiUserInfoInterface;
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
        $this->app->bind(DeleteSmaregiUserInfoInterface::class, DeleteSmaregiUserInfo::class);
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
