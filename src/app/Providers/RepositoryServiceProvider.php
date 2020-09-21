<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Customers\Models\Repositories\CustomerRepository;
use App\Adapters\Customers\Models\Repositories\SyncHistoryRepository;
use App\Adapters\Customers\Models\Repositories\TransactionRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiTokenRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiUserInfoRepository;
use App\Adapters\Shared\Models\Repositories\SmaregiUserTokenRepository;
use App\Adapters\Shared\Models\Repositories\SyncNecessaryRepository;
use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Models\Repositories\CustomerRepositoryInterface;
use Smareco\Customers\Models\Repositories\TransactionRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiTokenRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserInfoRepositoryInterface;
use Smareco\Shared\Models\Repositories\SmaregiUserTokenRepositoryInterface;
use Smareco\Shared\Models\Repositories\SyncHistoryRepositoryInterface;
use Smareco\Shared\Models\Repositories\SyncNecessaryRepositoryInterface;

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
        $this->app->bind(SyncHistoryRepositoryInterface::class, SyncHistoryRepository::class);
        $this->app->bind(SyncNecessaryRepositoryInterface::class, SyncNecessaryRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
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
