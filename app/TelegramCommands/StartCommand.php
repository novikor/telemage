<?php

declare(strict_types=1);

namespace App\TelegramCommands;

use App\TelegramCommands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot): void
    {
        $bot->sendMessage(
            sprintf(
                "Hello! To connect your account, please log in on %s and click a 'Connect Telegram' button.",
                $this->getIntegration($bot)->magento_base_url
            )
        );
    }
}
