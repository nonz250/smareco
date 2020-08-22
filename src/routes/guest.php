<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('pages.vue');
})->name('login');

Route::get('term', function () {
    return view('pages.vue');
})->name('term');

Route::get('privacy_policy', function () {
    return view('pages.vue');
})->name('privacy_policy');

Route::get('support', function () {
    return view('pages.vue');
})->name('support');
