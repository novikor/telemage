<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Services\Magento\Customer\GetCustomerData;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot, GetCustomerData $getCustomer): void
    {
        $telegramUser = $this->getTelegramUser($bot);
        if ($telegramUser && $magentoCustomer = $getCustomer($telegramUser)) {
            $bot->sendMessage(
                sprintf(
                    "Welcome back, %s %s!\nYou are logged in as %s.",
                    $magentoCustomer->firstname,
                    $magentoCustomer->lastname,
                    $magentoCustomer->email
                )
            );

            return;
        }

        $bot->sendMessage(
            sprintf(
                "Hello! To connect your account, please log in on %s and click a 'Connect Telegram' button.",
                $this->getIntegration($bot)->magento_base_url
            )
        );
    }
}
