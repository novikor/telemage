<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;

class TelegramWebhookController extends Controller
{
    /**
     * Handle incoming Telegram webhook requests.
     */
    public function handle(Request $request, string $token)
    {
        // 1. Find the integration by its unique webhook token
        $integration = Integration::whereWebhookToken($token)->firstOrFail();

        // 2. Create a Nutgram instance with this integration's specific bot token
        $bot = new Nutgram($integration->bot_token);
        $bot->setRunningMode(Webhook::class);

        // 3. Define bot handlers
        // TODO: This logic should be moved to dedicated handler classes later
        $bot->onCommand('start', function (Nutgram $bot) use ($integration): void {
            $bot->sendMessage(
                sprintf(
                    'Hello from %s! Your chat_id is %d. This is Integration ID: %d',
                    $bot->getMe()->first_name,
                    $bot->chatId(),
                    $integration->id
                )
            );
        });

        // 4. Run the bot
        try {
            $bot->run();

            // 5. Respond to Telegram
            return response()->noContent();
        } catch (\Exception $e) {
            Log::error('Nutgram run failed for integration '.$integration->id, ['error' => $e]);
            abort(500);
        }

    }
}
