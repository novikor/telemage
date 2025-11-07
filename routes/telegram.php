<?php

declare(strict_types=1);

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
$bot->onCommand('start {referralId}', LoginCommand::class);

$bot->onCommand('help', HelpCommand::class)->description('Show help');
