<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Telegram;

use App\Http\Controllers\Controller;
use App\Services\TelegramBotApiService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class WebhookController extends Controller
{
    /**
     * Handle incoming Telegram webhook requests.
     *
     * @throws BindingResolutionException
     */
    public function handle(TelegramBotApiService $botApiService, string $token): Response
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
