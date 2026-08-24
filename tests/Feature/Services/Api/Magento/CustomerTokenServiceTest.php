<?php

declare(strict_types=1);

use App\Api\Magento\Rest\Actions\GetCustomerTokenByJWE;
use App\Api\Magento\Rest\Utils\JWTParser;
use App\Models\Integration;
use App\Models\TelegramUser;
use App\Services\Api\Magento\CustomerTokenService;
use App\Services\JweService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;

beforeEach(function () {
    Http::preventStrayRequests();
    test()->freezeTime();
    test()->integration = Integration::factory()->create(['bot_token' => null]);
    test()->telegramUser = TelegramUser::factory()->for(test()->integration)->create();
    test()->cacheKey = sprintf(
        '%s_%d',
        test()->integration->webhook_token,
        test()->telegramUser->customer_id,
    );
});

it('exchanges and caches a customer token on a cache miss', function () {
    $jweService = Mockery::mock(JweService::class, function (MockInterface $mock): void {
        $mock->expects('generateForCustomer')
            ->once()
            ->withArgs(fn (Integration $integration, int $customerId): bool => $integration->is(test()->integration)
                && $customerId === test()->telegramUser->customer_id)
            ->andReturn('generated-jwe');
    });
    $getCustomerTokenByJWE = Mockery::mock(GetCustomerTokenByJWE::class, function (MockInterface $mock): void {
        $mock->expects('__invoke')
            ->once()
            ->withArgs(fn (Integration $integration, string $jwe): bool => $integration->is(test()->integration)
                && $jwe === 'generated-jwe')
            ->andReturn('magento-token');
    });
    $jwtParser = Mockery::mock(JWTParser::class, function (MockInterface $mock): void {
        $mock->expects('getExpiration')
            ->once()
            ->with('magento-token')
            ->andReturn(now()->addMinutes(10));
    });
    $service = new CustomerTokenService($getCustomerTokenByJWE, $jweService, $jwtParser);

    expect($service->getCustomerToken(test()->telegramUser))->toBe('magento-token')
        ->and(Cache::get(test()->cacheKey))->toBe('magento-token');

    test()->travel(7)->minutes();
    test()->travel(59)->seconds();
    expect(Cache::get(test()->cacheKey))->toBe('magento-token');

    test()->travel(1)->second();
    expect(Cache::get(test()->cacheKey))->toBeNull();
});

it('returns a valid cached token without exchanging it', function () {
    Cache::put(test()->cacheKey, 'cached-token');
    $jweService = Mockery::mock(JweService::class, function (MockInterface $mock): void {
        $mock->expects('generateForCustomer')->never();
    });
    $getCustomerTokenByJWE = Mockery::mock(GetCustomerTokenByJWE::class, function (MockInterface $mock): void {
        $mock->expects('__invoke')->never();
    });
    $jwtParser = Mockery::mock(JWTParser::class, function (MockInterface $mock): void {
        $mock->expects('getExpiration')
            ->once()
            ->with('cached-token')
            ->andReturn(now()->addMinute());
    });
    $service = new CustomerTokenService($getCustomerTokenByJWE, $jweService, $jwtParser);

    expect($service->getCustomerToken(test()->telegramUser))->toBe('cached-token');
});

it('replaces an expired cached token', function () {
    Cache::put(test()->cacheKey, 'expired-token');
    $jweService = Mockery::mock(JweService::class, function (MockInterface $mock): void {
        $mock->expects('generateForCustomer')
            ->once()
            ->withArgs(fn (Integration $integration, int $customerId): bool => $integration->is(test()->integration)
                && $customerId === test()->telegramUser->customer_id)
            ->andReturn('generated-jwe');
    });
    $getCustomerTokenByJWE = Mockery::mock(GetCustomerTokenByJWE::class, function (MockInterface $mock): void {
        $mock->expects('__invoke')
            ->once()
            ->withArgs(fn (Integration $integration, string $jwe): bool => $integration->is(test()->integration)
                && $jwe === 'generated-jwe')
            ->andReturn('refreshed-token');
    });
    $jwtParser = Mockery::mock(JWTParser::class, function (MockInterface $mock): void {
        $mock->expects('getExpiration')
            ->once()
            ->with('expired-token')
            ->andReturn(now()->subSecond());
        $mock->expects('getExpiration')
            ->once()
            ->with('refreshed-token')
            ->andReturn(now()->addMinutes(10));
    });
    $service = new CustomerTokenService($getCustomerTokenByJWE, $jweService, $jwtParser);

    expect($service->getCustomerToken(test()->telegramUser))->toBe('refreshed-token')
        ->and(Cache::get(test()->cacheKey))->toBe('refreshed-token');
});
