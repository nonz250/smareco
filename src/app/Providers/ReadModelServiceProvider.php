<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Analyzed\Models\ReadModels\GetAnalyzed;
use App\Adapters\Customers\Models\ReadModels\GetCustomer;
use App\Adapters\Shared\Models\ReadModels\GetSyncHistory;
use App\Adapters\Shared\Models\ReadModels\GetSyncNecessary;
use Illuminate\Support\ServiceProvider;
use Smareco\Analyzed\Query\GetAnalyzedQuery;
use Smareco\Customers\Query\GetCustomerQuery;
use Smareco\Shared\Models\Queries\GetSyncHistoryQuery;
use Smareco\Shared\Models\Queries\GetSyncNecessaryQuery;

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
        $this->app->bind(GetSyncNecessaryQuery::class, GetSyncNecessary::class);
        $this->app->bind(GetAnalyzedQuery::class, GetAnalyzed::class);
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
