<?php

declare(strict_types=1);

use App\Telegram\Commands\HelpCommand;
use App\Telegram\Commands\LoginCommand;
use App\Telegram\Commands\MeCommand;
use App\Telegram\Commands\ShowRecentOrdersCommand;
use App\Telegram\Commands\StartCommand;
use App\Telegram\Commands\ViewOrderCommand;
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
    $bot->onCommand('help', HelpCommand::class)->description('Show help');

    $bot->onCommand('me', MeCommand::class)->description('Show your account details');
    $bot->onCommand('recent_orders', ShowRecentOrdersCommand::class)->description('Show your recent orders');
    $bot->onCommand('view_order {orderNumber}', ViewOrderCommand::class)->description('View a specific order');
    $bot->onCallbackQueryData('reorder {orderNumber}', function (Nutgram $bot, string $orderNumber): void {
        $bot->answerCallbackQuery(
            text: 'Reorder '.$orderNumber
        );
    });
})
    ->scope(new BotCommandScopeAllPrivateChats)
    ->insensitive();

$bot->middleware(AuthenticateTelegramUser::class); // @phpstan-ignore-line

$bot->fallbackOn(UpdateType::MESSAGE, function (Nutgram $bot): void {
    if (! $bot->chat()?->isPrivate()) {
        $bot->sendMessage('Sorry, I can only work in private chats.');
    }
});
