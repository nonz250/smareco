<?php

use App\Http\Controllers\Apis\Customers\SyncCustomerAction;
use App\Http\Controllers\Apis\SmaregiUserInfo\GetSmaregiUserInfoAction;
use App\Http\Middleware\GenerateApiTokenMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', GetSmaregiUserInfoAction::class);

Route::middleware(GenerateApiTokenMiddleware::class)
    ->group(static function () {
        Route::prefix('customer')
            ->group(static function () {
                Route::post('sync', SyncCustomerAction::class);
            });
    });
