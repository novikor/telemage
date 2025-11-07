<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Magento;

use App\Models\Integration;
use App\Services\JweService;
use App\Services\ReferralIdStorageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class StoreLoginReferralId
{
    public function __invoke(
        Integration $integration,
        Request $request,
        JweService $jweService,
        ReferralIdStorageService $storage
    ): Response {
        $payload = $request->validate([
            'referralId' => ['required', 'string'],
            'jwe' => ['required', 'string'],
        ]);
        try {
            $jweService->validateAndGetCustomerId($integration, $payload['jwe']);
        } catch (Exception $e) {
            Log::warning($e->__toString());

            return response()->noContent(400);
        }

        $storage->store($integration, $payload['referralId'], $payload['jwe']);

        return response()->noContent();
    }
}
