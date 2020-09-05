<?php

use App\Http\Controllers\Apis\SmaregiWebhook\SmaregiWebhookAction;
use App\Http\Middleware\WebhookMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(WebhookMiddleware::class)
    ->group(static function () {
        Route::prefix('smaregi')
            ->group(static function () {
                Route::post('/', SmaregiWebhookAction::class);
            });
    });
