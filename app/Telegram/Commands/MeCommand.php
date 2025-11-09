<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Api\Magento\Data\Response\Customer;
use App\Models\TelegramUser;
use App\Services\Magento\Customer\GetCustomerData;
use App\Telegram\Commands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ParseMode;

class MeCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot, GetCustomerData $getCustomer): void
    {
        $customer = $this->getTelegramUser($bot);

        if (! $customer instanceof TelegramUser) {
            $bot->sendMessage(
                sprintf(
                    'You are not logged in. To connect your account, please log in on %s and click the \'Connect Telegram\' button.',
                    $this->getIntegration($bot)->magento_base_url
                )
            );

            return;
        }

        $magentoCustomer = ($getCustomer)($customer);

        if (! $magentoCustomer instanceof Customer) {
            $bot->sendMessage('Sorry, I could not retrieve your account details at this time.');

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
