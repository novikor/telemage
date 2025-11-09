<?php

declare(strict_types=1);

namespace App\Telegram\Commands;

use App\Telegram\Commands\Traits\ExtractsRequestData;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Types\Command\BotCommandScopeAllPrivateChats;

class HelpCommand
{
    use ExtractsRequestData;

    public function __invoke(Nutgram $bot): void
    {
        $bot->registerMyCommands();
        $commands = $bot->getMyCommands(new BotCommandScopeAllPrivateChats);
        $integration = $this->getIntegration($bot);
        $message = "Hello there! It's a bot for quick and safe interaction with {$integration->title} store.".
            "\nA List of available commands:\n\n";
        foreach ($commands as $command) {
            $message .= "/$command->command: $command->description\n";
        }
        $bot->sendMessage($message);
    }
}
