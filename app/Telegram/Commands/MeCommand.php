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
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class MeCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot, CustomerService $service): void
    {
        $telegramUser = $this->getTelegramUser($bot);

        if (! $telegramUser instanceof TelegramUser) {
            $bot->sendMessage(
                sprintf(
                    'You are not logged in. To connect your account, please log in on %s and click the \'Connect Telegram\' button.',
                    $this->getIntegration($bot)->magento_base_url
                )
            );

            return;
        }

        try {
            $magentoCustomer = $service->getCustomerData($telegramUser);
        } catch (ApiException|ConnectionException $e) {
            Log::error($e->__toString());
            $bot->sendMessage('Sorry, we could not retrieve your account details at this time.');

            return;
        }

        $bot->sendMessage(
            sprintf(
                "You are logged in to %s as:\n<b>Name:</b> %s %s\n<b>Email:</b> %s",
                $this->getIntegration($bot)->magento_base_url,
                $magentoCustomer->firstname,
                $magentoCustomer->lastname,
                $magentoCustomer->email
            ),
            parse_mode: ParseMode::HTML,
        );
    }
}
