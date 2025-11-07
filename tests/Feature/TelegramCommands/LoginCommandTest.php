<?php

declare(strict_types=1);

namespace Tests\Feature\TelegramCommands;

use App\Models\Integration;
use App\Models\TelegramUser;
use App\Services\JweService;
use App\Services\ReferralIdStorageService;
use App\TelegramCommands\LoginCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use InvalidArgumentException;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\Telegram\Properties\ChatType;
use SergiX44\Nutgram\Telegram\Types\Chat\Chat;
use SergiX44\Nutgram\Testing\FakeNutgram;

uses(RefreshDatabase::class);

function getBot(Integration $integration): FakeNutgram
{
    $bot = Nutgram::fake();
    $bot->set('integration', $integration);

    return $bot;
}

it('links telegram user on valid referral id and jwe', function () {
    $integration = Integration::factory()->create();
    $bot = getBot($integration);
    $chatId = 12345;
    $customerId = 67890;
    $referralId = Str::random();

    /** @var JweService $jweService */
    $jweService = app(JweService::class);
    $jwe = $jweService->generateForCustomer($integration, $customerId);

    /** @var ReferralIdStorageService $storage */
    $storage = app(ReferralIdStorageService::class);
    $storage->store($integration, $referralId, $jwe);

    $bot->onCommand('start {referralId}', LoginCommand::class);

    $bot
        ->setCommonChat(Chat::make($chatId, ChatType::PRIVATE))
        ->hearText("/start {$referralId}")
        ->reply()
        ->assertReplyMessage(['text' => 'Account successfully linked!']);

    test()->assertDatabaseHas(TelegramUser::class, [
        'integration_id' => $integration->id,
        'chat_id' => $chatId,
        'customer_id' => $customerId,
    ]);
});

it('shows start message if referral id is not found', function () {
    $integration = Integration::factory()->create();
    $bot = getBot($integration);
    $referralId = Str::random();
    $chatId = 12345;

    $bot->onCommand('start {referralId}', LoginCommand::class);

    $bot
        ->setCommonChat(Chat::make($chatId, ChatType::PRIVATE))
        ->hearText("/start {$referralId}")
        ->reply()
        ->assertReplyMessage([
            'text' => sprintf(
                "Hello! To connect your account, please log in on %s and click a 'Connect Telegram' button.",
                $integration->magento_base_url
            ),
        ]);
    test()->assertDatabaseCount(TelegramUser::class, 0);
});

it('throws exception on invalid jwe', function () {
    $integration = Integration::factory()->create();
    $otherIntegration = Integration::factory()->create();
    $bot = getBot($integration);
    $customerId = 67890;
    $referralId = Str::random();
    $chatId = 12345;

    /** @var JweService $jweService */
    $jweService = app(JweService::class);
    $jwe = $jweService->generateForCustomer($otherIntegration, $customerId);

    /** @var ReferralIdStorageService $storage */
    $storage = app(ReferralIdStorageService::class);
    $storage->store($integration, $referralId, $jwe);

    $bot->onCommand('start {referralId}', LoginCommand::class);

    $bot
        ->setCommonChat(Chat::make($chatId, ChatType::PRIVATE))
        ->hearText("/start {$referralId}")
        ->reply();
})->throws(InvalidArgumentException::class);
