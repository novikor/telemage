<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Magento\StoreLoginReferralId;
use App\Http\Controllers\Api\Telegram\WebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/telegram/webhook/{token}', [WebhookController::class, 'handle'])
    ->name('telegram.webhook');

Route::post('magento/login/referral/{integration}', StoreLoginReferralId::class)
    ->name('telegram.magento.login.referral.store');
