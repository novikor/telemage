<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Actions;

use App\Api\ApiException;
use App\Models\TelegramUser;
use App\Services\Api\Magento\CustomerTokenService;
use GraphQL\Query;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

abstract class GraphQlAction
{
    public function __construct(
        private readonly CustomerTokenService $customerTokenService,
    ) {}

    /**
     * @throws ConnectionException
     * @throws ApiException
     */
    protected function query(TelegramUser $user, string|Query $query, array $variables = []): Response
    {
        $token = $this->customerTokenService->getCustomerToken($user);
        $pendingRequest = Http::baseUrl(rtrim((string) $user->integration->magento_base_url, '/').'/graphql')
            ->withHeader('Authorization', "Bearer $token")
            ->acceptJson()
            ->throwIf(fn (Response $response) => is_array($response->json('errors', false)));
        if ($user->integration->store_code) {
            $pendingRequest->withHeader('Store', $user->integration->store_code);
        }

        try {
            return $pendingRequest
                ->post('graphql', ['query' => (string) $query, 'variables' => $variables])
                ->throw();
        } catch (RequestException  $e) {
            Log::error($e->__toString(), ['user' => $user->id]);
            throw new ApiException($e->response->json('errors', $e->getMessage()), 0, $e);
        }
    }
}
