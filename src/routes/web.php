<?php

use App\Http\Controllers\Actions\LogoutAction;
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

Route::get('home', function () {
    return response()->json([
        'test' => 'test',
    ]);
})->name('home');
