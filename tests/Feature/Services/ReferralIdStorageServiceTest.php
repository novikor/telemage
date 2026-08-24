<?php

declare(strict_types=1);

use App\Models\Integration;
use App\Services\ReferralIdStorageService;

beforeEach(function () {
    test()->storage = app(ReferralIdStorageService::class);
});

it('stores referral jwes for a specific integration and referral id', function () {
    $integration = Integration::factory()->create(['bot_token' => null]);
    $otherIntegration = Integration::factory()->create(['bot_token' => null]);

    test()->storage->store($integration, 'shared-referral', 'first-jwe');
    test()->storage->store($integration, 'other-referral', 'second-jwe');
    test()->storage->store($otherIntegration, 'shared-referral', 'third-jwe');

    expect(test()->storage->pull($integration, 'shared-referral'))->toBe('first-jwe')
        ->and(test()->storage->pull($integration, 'other-referral'))->toBe('second-jwe')
        ->and(test()->storage->pull($otherIntegration, 'shared-referral'))->toBe('third-jwe');
});

it('pulls a stored jwe only once', function () {
    $integration = Integration::factory()->create(['bot_token' => null]);

    test()->storage->store($integration, 'referral-id', 'stored-jwe');

    expect(test()->storage->pull($integration, 'referral-id'))->toBe('stored-jwe')
        ->and(test()->storage->pull($integration, 'referral-id'))->toBeNull();
});

it('expires a stored jwe after two minutes without sleeping', function () {
    test()->freezeTime();
    $integration = Integration::factory()->create(['bot_token' => null]);

    test()->storage->store($integration, 'referral-id', 'stored-jwe');
    test()->travel(2)->minutes();

    expect(test()->storage->pull($integration, 'referral-id'))->toBeNull();
});
