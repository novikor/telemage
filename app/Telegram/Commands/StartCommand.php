<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\ApiException;
use App\Models\TelegramUser;
use App\Services\Api\Magento\CustomerService;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot, CustomerService $service): void
    {
        $telegramUser = $this->getTelegramUser($bot);
        if (! $telegramUser instanceof TelegramUser) {
            $bot->sendMessage(
                sprintf(
                    "Hello! To connect your account, please log in on %s and click a 'Connect Telegram' button.",
                    $this->getIntegration($bot)->magento_base_url
                )
            );

            return;
        }
        try {
            $magentoCustomer = $service->getCustomerData($telegramUser);
            $bot->sendMessage(
                sprintf(
                    "Welcome back, %s %s!\nYou are logged in as %s.",
                    $magentoCustomer->firstname,
                    $magentoCustomer->lastname,
                    $magentoCustomer->email
                )
            );
        } catch (ApiException|ConnectionException $e) {
            Log::error($e->__toString());
            $bot->sendMessage('Sorry, we could not retrieve your account details at this time.');
        }
    }
}
