<?php

declare(strict_types=1);

namespace App\Telegram\Commands\Traits;

use App\Models\Integration;
use App\Models\TelegramUser;
use RuntimeException;
use SergiX44\Nutgram\Nutgram;

trait ExtractsRequestData
{
    protected function getIntegration(Nutgram $bot): Integration
    {
        $integration = $bot->get('integration');
        if (! $integration instanceof Integration) {
            throw new RuntimeException('Integration not found');
        }

        return $integration;
    }

    protected function getTelegramUser(Nutgram $bot): ?TelegramUser
    {
        $customer = $bot->get('customer');
        if (! $customer instanceof TelegramUser) {
            return null;
        }

        return $customer;
    }
}
