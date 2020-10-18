<?php
declare(strict_types=1);

use App\Http\Controllers\Apis\Notification\AINotificationAction;
use App\Http\Controllers\Apis\SmaregiWebhook\SmaregiWebhookAction;
use App\Http\Middleware\PublicWebhookMiddleware;
use App\Http\Middleware\WebhookMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(WebhookMiddleware::class)
    ->group(static function () {
        Route::prefix('smaregi')
            ->group(static function () {
                Route::post('/', SmaregiWebhookAction::class);
            });
    });

Route::middleware(PublicWebhookMiddleware::class)
    ->group(static function () {
        Route::prefix('ai')
            ->group(static function () {
                Route::prefix('notification')
                    ->group(static function () {
                        Route::post('/', AINotificationAction::class);
                    });
            });
    });
