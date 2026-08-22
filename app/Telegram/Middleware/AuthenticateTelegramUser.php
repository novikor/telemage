<?php

declare(strict_types=1);

namespace App\Telegram\Middleware;

use App\Models\Integration;
use RuntimeException;
use SergiX44\Nutgram\Nutgram;

class AuthenticateTelegramUser
{
    public function __invoke(Nutgram $bot, callable $next): void
    {
        $integration = $bot->get('integration');
        if (! $integration instanceof Integration) {
            throw new RuntimeException('Integration not found');
        }

        $telegramUser = $integration
            ->telegramUsers()
            ->whereChatId($bot->chatId())
            ->first();

        $bot->set('customer', $telegramUser);

        $next($bot);
    }
}
