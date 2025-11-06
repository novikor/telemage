<?php

declare(strict_types=1);

namespace App\TelegramCommands;

use App\TelegramCommands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;

class HelpCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot): void
    {
        $bot->registerMyCommands();
        $commands = $bot->getMyCommands();
        $integration = $this->getIntegration($bot);
        $message = "Hello there! It's a bot for quick and safe interaction with {$integration->title} store.".
            "\nA List of available commands:\n\n";
        foreach ($commands as $command) {
            $message .= "/$command->command: $command->description\n";
        }
        $bot->sendMessage($message);
    }
}
