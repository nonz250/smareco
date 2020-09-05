<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomers;
use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomersInterface;
use Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken\GenerateSmaregiToken;
use Smareco\SmaregiToken\Command\UseCases\GenerateSmaregiToken\GenerateSmaregiTokenInterface;
use Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo\DeleteSmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\DeleteSmaregiUserInfo\DeleteSmaregiUserInfoInterface;
use Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo\GetSmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo\GetSmaregiUserInfoInterface;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfo;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfoInterface;
use Smareco\SmaregiWebhook\SmaregiWebhook;
use Smareco\SmaregiWebhook\SmaregiWebhookInterface;

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
        $this->app->bind(GetSmaregiUserInfoInterface::class, GetSmaregiUserInfo::class);
        $this->app->bind(GenerateSmaregiTokenInterface::class, GenerateSmaregiToken::class);
        $this->app->bind(SyncCustomersInterface::class, SyncCustomers::class);
        $this->app->bind(SmaregiWebhookInterface::class, SmaregiWebhook::class);
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
