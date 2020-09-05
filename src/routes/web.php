<?php

use App\Http\Controllers\Actions\LogoutAction;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('logout', LogoutAction::class);

Route::view('home', 'pages.vue')->name('home');

Route::middleware(AuthMiddleware::class)->group(static function () {
    Route::view('customer', 'pages.vue')->name('customer.index');
});
