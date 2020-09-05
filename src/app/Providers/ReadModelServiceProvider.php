<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Customers\Models\ReadModels\GetCustomer;
use App\Adapters\Shared\Models\ReadModels\GetSyncHistory;
use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Query\GetCustomerQuery;
use Smareco\Shared\Models\Queries\GetSyncHistoryQuery;

class ReadModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetCustomerQuery::class, GetCustomer::class);
        $this->app->bind(GetSyncHistoryQuery::class, GetSyncHistory::class);
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
