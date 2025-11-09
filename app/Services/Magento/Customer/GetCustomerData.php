<?php

declare(strict_types=1);

namespace App\Services\Magento\Customer;

use App\Api\Magento\Actions\GetCustomerTokenByJWE;
use App\Api\Magento\Actions\GetMe;
use App\Api\Magento\Data\Response\Customer;
use App\Models\TelegramUser;
use App\Services\JweService;
use Exception;
use Illuminate\Support\Facades\Log;

readonly class GetCustomerData
{
    public function __construct(
        private JweService $jweService,
        private GetCustomerTokenByJWE $getCustomerTokenByJWE,
        private GetMe $getMe,
    ) {}

    public function __invoke(TelegramUser $telegramUser): ?Customer
    {
        try {
            $jwe = $this->jweService->generateForCustomer($telegramUser->integration, $telegramUser->customer_id);
            $customerToken = ($this->getCustomerTokenByJWE)($telegramUser->integration, $jwe);

            return ($this->getMe)($telegramUser->integration, $customerToken);
        } catch (Exception $e) {
            Log::error('Failed to get customer from Magento', [
                'telegram_user_id' => $telegramUser->id,
                'exception' => $e,
            ]);

            return null;
        }
    }
}
