<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\AIProcessHistory\Models\Factories\AIProcessFactory;
use App\Adapters\Shared\Models\Factories\SyncHistoryFactory;
use App\Adapters\Shared\Models\Factories\SyncNecessaryFactory;
use Illuminate\Support\ServiceProvider;
use Smareco\AIProcessHistory\Models\Factories\AIProcessFactoryInterface;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;
use Smareco\Shared\Models\Factories\SyncNecessaryFactoryInterface;

class FactoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SyncHistoryFactoryInterface::class, SyncHistoryFactory::class);
        $this->app->bind(SyncNecessaryFactoryInterface::class, SyncNecessaryFactory::class);
        $this->app->bind(AIProcessFactoryInterface::class, AIProcessFactory::class);
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
