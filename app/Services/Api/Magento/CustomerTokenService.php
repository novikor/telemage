<?php

declare(strict_types=1);

namespace App\Services\Api\Magento;

use App\Api\ApiException;
use App\Api\Magento\Actions\GetCustomerTokenByJWE;
use App\Api\Magento\Utils\JWTParser;
use App\Models\TelegramUser;
use App\Services\JweService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;

readonly class CustomerTokenService
{
    public function __construct(
        private GetCustomerTokenByJWE $getCustomerTokenByJWE,
        private JweService $jweService,
        private JWTParser $jwtParser
    ) {}

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function getCustomerToken(TelegramUser $user): string
    {
        $jwe = $this->jweService->generateForCustomer($user->integration, $user->customer_id);
        $cacheKey = sprintf('%s_%d', $user->integration->webhook_token, $user->customer_id);
        if ($cachedToken = $this->getCachedToken($cacheKey)) {
            return $cachedToken;
        }
        $newToken = ($this->getCustomerTokenByJWE)($user->integration, $jwe);
        $this->cacheToken($cacheKey, $newToken);

        return $newToken;
    }

    private function cacheToken(string $key, string $token): void
    {
        Cache::put($key, $token, $this->jwtParser->getExpiration($token)->subMinutes(2));
    }

    private function getCachedToken(string $key): ?string
    {
        $token = Cache::get($key);
        if ($token === null || $this->jwtParser->getExpiration($token)->isNowOrPast()) {
            return null;
        }

        return $token;
    }
}
