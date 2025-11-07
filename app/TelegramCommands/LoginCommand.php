<?php

declare(strict_types=1);

namespace App\TelegramCommands;

use App\Models\TelegramUser;
use App\Services\JweService;
use App\Services\ReferralIdStorageService;
use App\TelegramCommands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;

class LoginCommand
{
    use ExtractsRequestData;

    public function __invoke(
        Nutgram $bot,
        string $referralId,
        JweService $jweService,
        ReferralIdStorageService $storage
    ): void {
        $integration = $this->getIntegration($bot);
        $token = $storage->pull($integration, $referralId);
        if (blank($token)) {
            app()->call(StartCommand::class, ['bot' => $bot]);

            return;
        }

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
