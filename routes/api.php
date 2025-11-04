<?php

declare(strict_types=1);

use App\Http\Controllers\Api\TelegramWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/webhook/{token}', [TelegramWebhookController::class, 'handle'])
    ->name('telegram.webhook');
