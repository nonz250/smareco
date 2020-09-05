<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Shared\Models\Factories\SyncHistoryFactory;
use Illuminate\Support\ServiceProvider;
use Smareco\Shared\Models\Factories\SyncHistoryFactoryInterface;

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
