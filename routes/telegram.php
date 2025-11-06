<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use SergiX44\Nutgram\Nutgram;

/**
 * @var Nutgram $bot
 * @var Application $app
 */
$bot->onCommand('start', function (Nutgram $bot): void {
    $bot->sendMessage(
        sprintf(
            'Hello from %s! Your chat_id is %d. This is Integration ID: %d',
            $bot->getMe()->first_name,
            $bot->chatId(),
            $bot->get('integration')->id
        )
    );
});
