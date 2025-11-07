<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Integration;
use Illuminate\Support\Facades\Cache;

class ReferralIdStorageService
{
    private const int CACHE_LIFETIME_MINUTES = 2;

    private const string CACHE_KEY_PATTERN = 'referral_%d_%s';

    public function store(Integration $integration, string $referralId, string $jwe): void
    {
        Cache::put(
            key: $this->getKey($integration, $referralId),
            value: $jwe,
            ttl: now()->addMinutes(self::CACHE_LIFETIME_MINUTES)
        );
    }

    public function pull(Integration $integration, string $referralId): ?string
    {
        return Cache::pull(
            key: $this->getKey($integration, $referralId)
        );
    }

    private function getKey(Integration $integration, string $referralId): string
    {
        return sprintf(self::CACHE_KEY_PATTERN, $integration->id, $referralId);
    }
}
