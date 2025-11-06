<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Integration;
use App\Services\TelegramBotApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

readonly class IntegrationObserver
{
    public function __construct(
        private TelegramBotApiService $botApiService,
    ) {}

    /**
     * Handle the Integration "creating" event.
     * This fires *before* the record is created.
     */
    public function creating(Integration $integration): void
    {
        // Generate the unique token for the webhook URL
        if (empty($integration->webhook_token)) {
            $integration->webhook_token = Str::ulid()->toString();
        }
    }

    /**
     * Handle the Integration "saved" event.
     * This fires *after* the record is created OR updated.
     */
    public function saved(Integration $integration): void
    {
        // Check if the bot_token was just changed (or set for the first time)
        // and is not empty.
        if (
            ($integration->wasChanged('bot_token') || ! $integration->webhook_is_configured)
            && filled($integration->bot_token)
        ) {
            // TODO: extract into action or service
            try {
                $bot = $this->botApiService->initializeBotInstance($integration->bot_token);

                // Generate the full, secure webhook URL using our named route
                $webhookUrl = route('telegram.webhook', ['token' => $integration->webhook_token]);
                if (app()->hasDebugModeEnabled() && app()->isLocal()) {
                    $webhookUrl .= '?XDEBUG_TRIGGER=1';
                }

                // Set the webhook with Telegram
                $bot->setWebhook($webhookUrl);
                $bot->registerMyCommands();

                // Update the status (use saveQuietly to avoid firing 'saved' event again)
                $integration->webhook_is_configured = true;
                $integration->saveQuietly();

            } catch (Throwable $e) {
                // If the token is invalid or Telegram API fails
                Log::error('Failed to set webhook for integration '.$integration->id, ['error' => $e]);

                $integration->webhook_is_configured = false;
                $integration->saveQuietly();
            }
        }
    }
}
