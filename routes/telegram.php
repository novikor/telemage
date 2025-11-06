<?php

declare(strict_types=1);

use App\Services\JweService;
use App\TelegramCommands\HelpCommand;
use App\TelegramCommands\LoginCommand;
use App\TelegramCommands\StartCommand;
use Illuminate\Foundation\Application;
use SergiX44\Nutgram\Nutgram;

/**
 * @var Nutgram $bot
 * @var Application $app
 */
$bot->onCommand('start', StartCommand::class)->description('Start interaction with the bot');
$bot->onCommand('login {token}', LoginCommand::class);

$bot->onCommand('help', HelpCommand::class)->description('Show help');

if (app()->isLocal()) {
    $bot->onCommand('generate_test_jwe {customer_id}', function (Nutgram $bot, int $customer_id): void {
        $integration = $bot->get('integration');

        /** @var JweService $jweService */
        $jweService = app(JweService::class);
        $jweToken = $jweService->generateForCustomer($integration, $customer_id);

        $bot->sendMessage($jweToken);
    });
}
