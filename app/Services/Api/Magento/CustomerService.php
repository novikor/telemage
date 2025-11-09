<?php

declare(strict_types=1);

namespace App\Services\Api\Magento;

use App\Api\ApiException;
use App\Api\Magento\Actions\GetMe;
use App\Api\Magento\Data\Response\Customer;
use App\Models\TelegramUser;
use Illuminate\Http\Client\ConnectionException;

readonly class CustomerService
{
    public function __construct(
        private CustomerTokenService $customerTokenService,
        private GetMe $getMe,
    ) {}

    /**
     * @throws ApiException
     * @throws ConnectionException
     */
    public function getCustomerData(TelegramUser $telegramUser): Customer
    {
        return ($this->getMe)($telegramUser->integration, $this->customerTokenService->getCustomerToken($telegramUser));
    }
}
