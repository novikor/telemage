<?php

declare(strict_types=1);

namespace App\Api\Magento\Actions;

use App\Api\ApiException;
use App\Api\Magento\Traits\CallsMagentoRestAPI;
use App\Models\Integration;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;
use SensitiveParameter;

class GetMe
{
    use CallsMagentoRestAPI;

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(Integration $integration, #[SensitiveParameter] string $customerToken): string
    {
        try {
            return $this->getMe($integration, $customerToken);
        } catch (RequestException  $e) {
            Log::error($e->__toString(), ['integration_id' => $integration->id]);
            throw new ApiException($e->response->json('message'), 0, $e);
        }
    }

    /**
     * @throws RequestException
     * @throws ApiException
     * @throws ConnectionException
     */
    private function getMe(Integration $integration, string $customerToken): string
    {
        $response = $this->call($integration)
            ->withHeader('Authorization', 'Bearer '.$customerToken)
            ->get('V1/customers/me');

        return $response->json();
    }
}
