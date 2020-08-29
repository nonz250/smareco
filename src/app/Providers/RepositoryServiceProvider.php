<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Customers\Models\Repositories\CustomerRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiTokenRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiUserInfoRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiUserTokenRepository;
use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiTokenRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserTokenRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SmaregiUserTokenRepositoryInterface::class, SmaregiUserTokenRepository::class);
        $this->app->bind(SmaregiUserInfoRepositoryInterface::class, SmaregiUserInfoRepository::class);
        $this->app->bind(SmaregiTokenRepositoryInterface::class, SmaregiTokenRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
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
