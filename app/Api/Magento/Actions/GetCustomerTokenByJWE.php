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

readonly class GetCustomerTokenByJWE
{
    use CallsMagentoRestAPI;

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function __invoke(Integration $integration, #[SensitiveParameter] string $jwe): string
    {
        try {
            return $this->requestToken($integration, $jwe);
        } catch (RequestException  $e) {
            Log::error($e->__toString(), ['integration_id' => $integration->id]);
            throw new ApiException($e->response->json('message', ''), 0, $e);
        }
    }

    /**
     * @throws RequestException
     * @throws ApiException
     * @throws ConnectionException
     */
    private function requestToken(Integration $integration, string $jwe): string
    {
        $response = $this->call($integration)
            ->post('V1/telemage/customer/token/byJWE', ['jwe' => $jwe])
            ->throw();
        $customerToken = $response->json();
        if (! is_string($customerToken)) {
            throw new ApiException(
                'Invalid response from Magento when requesting customer token by JWE.', previous: new RequestException($response)
            );
        }

        return $customerToken;
    }
}
