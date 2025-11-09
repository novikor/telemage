<?php

declare(strict_types=1);

namespace App\Api\Magento\Traits;

use App\Models\Integration;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

trait CallsMagentoRestAPI
{
    protected function call(Integration $integration): PendingRequest
    {
        $storeCode = $integration->store_code ?: '';
        $apiUrl = rtrim((string) $integration->magento_base_url, '/')."/rest/$storeCode/";

        return Http::baseUrl($apiUrl);
    }
}
