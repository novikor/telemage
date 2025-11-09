<?php

declare(strict_types=1);

namespace App\Telegram\Middleware;

use App\Models\TelegramUser;
use SergiX44\Nutgram\Nutgram;

class AuthenticateTelegramUser
{
    public function __invoke(Nutgram $bot, callable $next): void
    {
        $bot->set('customer', TelegramUser::whereChatId($bot->chatId())->first());

        $next($bot);
    }
}
