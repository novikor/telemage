<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TelegramBotApiService;
use Illuminate\Support\Facades\Log;
use SergiX44\Nutgram\RunningMode\Webhook;
use Throwable;

class TelegramWebhookController extends Controller
{
    /**
     * Handle incoming Telegram webhook requests.
     */
    public function handle(TelegramBotApiService $botApiService, string $token)
    {
        $bot = $botApiService->initializeBotInstance($token);
        try {
            $bot->run();

            return response()->noContent();
        } catch (Throwable $e) {
            Log::error('Telegram Bot request failure', [
                'error' => $e,
                'integration' => $bot->get('integration')?->id,
                'user' => $bot->get('user')?->id,
            ]);
            if (app()->isLocal() && app()->hasDebugModeEnabled()) {
                $bot->sendMessage($e->getMessage());

                return response()->noContent();
            }
            $bot->sendMessage('Something went wrong. Please try again later.');
            abort(500);
        }
    }
}
