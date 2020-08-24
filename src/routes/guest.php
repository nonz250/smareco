<?php
declare(strict_types=1);

use App\Http\Controllers\Actions\Smaregi\RedirectSmaregiUserAuthAction;
use App\Http\Controllers\Actions\Smaregi\SmaregiUserAuthAction;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.vue')->name('top');
Route::view('login', 'pages.vue')->name('login');
Route::view('term', 'pages.vue')->name('term');
Route::view('privacy_policy', 'pages.vue')->name('privacy_policy');
Route::view('support', 'pages.vue')->name('support');

Route::get('smaregi/openid', SmaregiUserAuthAction::class)->name('openid');
Route::post('smaregi/openid', RedirectSmaregiUserAuthAction::class);
