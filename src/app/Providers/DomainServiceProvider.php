<?php
declare(strict_types=1);

namespace App\Providers;

use App\Adapters\Customers\Services\AIService;
use App\Adapters\Customers\Services\TransactionService;
use Illuminate\Support\ServiceProvider;
use Smareco\Customers\Models\Services\AIServiceInterface;
use Smareco\Customers\Models\Services\TransactionServiceInterface;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AIServiceInterface::class, AIService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
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
