<?php

declare(strict_types=1);

namespace App\TelegramCommands\Traits;

use App\Models\Integration;
use SergiX44\Nutgram\Nutgram;

trait ExtractsRequestData
{
    protected function getIntegration(Nutgram $bot): Integration
    {
        $integration = $bot->get('integration');
        if (! $integration instanceof Integration) {
            throw new \RuntimeException('Integration not found');
        }

        return $integration;
    }
}
