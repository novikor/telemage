<?php

declare(strict_types=1);

namespace App\Api\Magento\Rest\Actions;

use App\Api\ApiException;
use App\Api\Magento\Rest\Data\Customer;
use App\Api\Magento\Rest\Traits\CallsMagentoRestAPI;
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
    public function __invoke(Integration $integration, #[SensitiveParameter] string $customerToken): Customer
    {
        try {
            return $this->getMe($integration, $customerToken);
        } catch (RequestException  $e) {
            Log::error($e->__toString(), ['integration_id' => $integration->id]);
            throw new ApiException($e->response->json('message', ''), 0, $e);
        }
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    private function getMe(Integration $integration, string $customerToken): Customer
    {
        $response = $this->call($integration)
            ->withHeader('Authorization', 'Bearer '.$customerToken)
            ->get('V1/customers/me')
            ->throw();

        return Customer::fromArray($response->json());
    }
}
