<?php

declare(strict_types=1);

namespace App\TelegramCommands;

use App\Models\TelegramUser;
use App\Services\JweService;
use App\TelegramCommands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;

class LoginCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot, JweService $jweService, string $token): void
    {
        $integration = $this->getIntegration($bot);
        $customerId = $jweService->validateAndGetCustomerId($integration, $token);

        TelegramUser::query()->updateOrCreate(
            attributes: [
                'integration_id' => $integration->id,
                'chat_id' => $bot->chatId(),
            ],
            values: [
                'customer_id' => $customerId,
            ]
        );

        $bot->sendMessage('Account successfully linked!');
    }
}
