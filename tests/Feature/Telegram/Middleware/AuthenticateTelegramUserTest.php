<?php

declare(strict_types=1);

use App\Models\Integration;
use App\Models\TelegramUser;
use App\Telegram\Middleware\AuthenticateTelegramUser;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;

it('authenticates telegram user within the current integration', function () {
    $chatId = 12345;
    $firstIntegration = Integration::factory()->create();
    $currentIntegration = Integration::factory()->create();
    TelegramUser::factory()->create([
        'integration_id' => $firstIntegration->id,
        'chat_id' => $chatId,
        'customer_id' => 111,
    ]);
    $currentTelegramUser = TelegramUser::factory()->create([
        'integration_id' => $currentIntegration->id,
        'chat_id' => $chatId,
        'customer_id' => 222,
    ]);
    $bot = Nutgram::fake()
        ->setCommonChat(Chat::make($chatId, ChatType::PRIVATE))
        ->hearText('test');
    $bot->set('integration', $currentIntegration);
    $nextWasCalled = false;
    $bot->onMessage(function () use (&$nextWasCalled): void {
        $nextWasCalled = true;
    });
    $bot->middleware(AuthenticateTelegramUser::class);

    $bot->reply();

    expect($bot->get('customer')?->is($currentTelegramUser))->toBeTrue()
        ->and($nextWasCalled)->toBeTrue();
});

it('continues without a customer when chat is not linked to the current integration', function () {
    $integration = Integration::factory()->create();
    $bot = Nutgram::fake()
        ->setCommonChat(Chat::make(12345, ChatType::PRIVATE))
        ->hearText('test');
    $bot->set('integration', $integration);
    $nextWasCalled = false;
    $bot->onMessage(function () use (&$nextWasCalled): void {
        $nextWasCalled = true;
    });
    $bot->middleware(AuthenticateTelegramUser::class);

    $bot->reply();

    expect($bot->get('customer'))->toBeNull()
        ->and($nextWasCalled)->toBeTrue();
});

it('throws when integration is missing from the bot context', function () {
    $bot = Nutgram::fake()
        ->setCommonChat(Chat::make(12345, ChatType::PRIVATE))
        ->hearText('test');
    $bot->onMessage(static function (): void {});
    $bot->middleware(AuthenticateTelegramUser::class);

    $bot->reply();
})->throws(RuntimeException::class, 'Integration not found');
