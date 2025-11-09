<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Integration;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Psr\SimpleCache\CacheInterface;
use SergiX44\Nutgram\Configuration;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;

class TelegramBotApiService
{
    /**
     * @throws BindingResolutionException
     * @throws ModelNotFoundException
     */
    public function initializeBotInstance(string $integrationToken): Nutgram
    {
        $integration = Integration::whereWebhookToken($integrationToken)->firstOrFail();

        $bot = app()->make(Nutgram::class, [
            'token' => $integration->bot_token,
            'config' => new Configuration(
                container: app(),
                cache: app(CacheInterface::class),
                logger: Log::channel('telegram_api_debug')
            ),
        ]);
        $bot->setRunningMode(Webhook::class);
        $bot->set('integration', $integration);

        return $bot;
    }
}
