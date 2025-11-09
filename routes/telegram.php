<?php

declare(strict_types=1);

use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\LoginCommand;
use App\Telegram\Commands\MeCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Middleware\AuthenticateTelegramUser;
use Illuminate\Foundation\Application;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\UpdateType;
use SergiX44\Nutgram\Telegram\Types\Command\BotCommandScopeAllPrivateChats;

/**
 * @var Nutgram $bot
 * @var Application $app
 */
$bot->group(function (Nutgram $bot): void {
    $bot->onCommand('start', StartCommand::class)->description('Start interaction with the bot');
    $bot->onCommand('start {referralId}', LoginCommand::class);

    $bot->onCommand('me', MeCommand::class)->description('Show your account details');
    $bot->onCommand('help', HelpCommand::class)->description('Show help');
})
    ->scope(new BotCommandScopeAllPrivateChats)
    ->middleware(AuthenticateTelegramUser::class)
    ->insensitive();

$bot->fallbackOn(UpdateType::MESSAGE, function (Nutgram $bot): void {
    if (! $bot->chat()?->isPrivate()) {
        $bot->sendMessage('Sorry, I can only work in private chats.');
    }
});
