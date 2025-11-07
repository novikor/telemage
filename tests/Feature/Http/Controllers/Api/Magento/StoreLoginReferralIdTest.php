<?php

declare(strict_types=1);

use App\Models\Integration;
use App\Services\JweService;
use App\Services\ReferralIdStorageService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

it('stores the jwe in cache with a referral id on valid request', function () {
    $integration = Integration::factory()->create();
    /** @var JweService $jweService */
    $jweService = app(JweService::class);
    $jwe = $jweService->generateForCustomer($integration, 123);
    $referralId = Str::random();

    $response = test()->postJson(route('telegram.magento.login.referral.store', $integration), [
        'referralId' => $referralId,
        'jwe' => $jwe,
    ]);

    $response->assertNoContent();

    /** @var ReferralIdStorageService $storageService */
    $storageService = app(ReferralIdStorageService::class);
    $cachedJwe = $storageService->pull($integration, $referralId);

    expect($cachedJwe)->toBe($jwe);
});

it('returns bad request if jwe is invalid', function () {
    $integration = Integration::factory()->create();
    $invalidIntegration = Integration::factory()->create();
    /** @var JweService $jweService */
    $jweService = app(JweService::class);
    $jwe = $jweService->generateForCustomer($invalidIntegration, 123);
    $referralId = Str::random();

    $response = test()->postJson(route('telegram.magento.login.referral.store', $integration), [
        'referralId' => $referralId,
        'jwe' => $jwe,
    ]);

    $response->assertStatus(400);

    $key = 'referral_'.$integration->id.'_'.$referralId;
    expect(Cache::has($key))->toBeFalse();
});

it('returns validation error for missing parameters', function () {
    $integration = Integration::factory()->create();

    $response = test()->postJson(route('telegram.magento.login.referral.store', $integration), []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['referralId', 'jwe']);
});
