<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Customers\Models\ReadModels\GetCustomer;
use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Query\GetCustomerQuery;

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
