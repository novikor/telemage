<?php

declare(strict_types=1);

use App\Models\Integration;
use App\Observers\IntegrationObserver;
use App\Services\TelegramBotApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\RunningMode;
use SergiX44\Nutgram\RunningMode\Webhook;

it('generates and encrypts a webhook secret token when creating an integration', function () {
    $integration = Integration::factory()->create(['bot_token' => null]);
    $secretToken = $integration->webhook_secret_token;
    $storedToken = DB::table('integrations')
        ->where('id', $integration->id)
        ->value('webhook_secret_token');

    expect($secretToken)
        ->toBeString()
        ->toHaveLength(64)
        ->toMatch('/\A[A-Za-z0-9]{64}\z/')
        ->and($storedToken)
        ->toBeString()
        ->not->toBe($secretToken)
        ->and($integration->fresh()->webhook_secret_token)
        ->toBe($secretToken);
});

it('keeps the webhook secret token when an integration changes', function () {
    $integration = Integration::factory()->create(['bot_token' => null]);
    $secretToken = $integration->webhook_secret_token;

    $integration->title = 'Updated title';
    $integration->bot_token = 'updated-bot-token';
    $integration->saveQuietly();

    expect($integration->fresh()->webhook_secret_token)->toBe($secretToken);
});

it('configures Nutgram webhook safe mode with the integration secret', function () {
    $secretToken = Str::random(64);
    $integration = Integration::withoutEvents(function () use ($secretToken): Integration {
        $integration = Integration::factory()->create(['bot_token' => 'bot-token']);
        $integration->forceFill([
            'webhook_token' => Str::ulid()->toString(),
            'webhook_secret_token' => $secretToken,
        ])->save();

        return $integration;
    });

    $bot = app(TelegramBotApiService::class)->initializeBotInstance($integration->webhook_token);
    $runningMode = $bot->getContainer()->get(RunningMode::class);
    $configuredSecretToken = new ReflectionProperty(Webhook::class, 'secretToken')->getValue($runningMode);

    expect($runningMode)
        ->toBeInstanceOf(Webhook::class)
        ->and($runningMode->isSafeMode())
        ->toBeTrue()
        ->and($configuredSecretToken)
        ->toBe($secretToken);
});

it('registers the webhook using the integration secret', function () {
    $secretToken = Str::random(64);
    $webhookToken = Str::ulid()->toString();
    $integration = Integration::withoutEvents(function () use ($webhookToken, $secretToken): Integration {
        $integration = Integration::factory()->create(['bot_token' => 'bot-token']);
        $integration->forceFill([
            'webhook_token' => $webhookToken,
            'webhook_secret_token' => $secretToken,
            'webhook_is_configured' => false,
        ])->save();

        return $integration;
    });
    $webhookUrl = route('telegram.webhook', ['token' => $webhookToken]);

    $bot = Mockery::mock(Nutgram::class, function (MockInterface $mock) use ($webhookUrl, $secretToken): void {
        $mock->expects('setWebhook')
            ->once()
            ->withArgs(fn (...$arguments): bool => $arguments[0] === $webhookUrl
                && $arguments[6] === $secretToken)
            ->andReturnTrue();
        $mock->expects('registerMyCommands')->once();
    });
    $botApiService = Mockery::mock(TelegramBotApiService::class, function (MockInterface $mock) use ($webhookToken, $bot): void {
        $mock->expects('initializeBotInstance')
            ->once()
            ->with($webhookToken)
            ->andReturn($bot);
    });

    new IntegrationObserver($botApiService)->saved($integration);

    $integration->refresh();

    expect($integration->webhook_is_configured)
        ->toBeTrue()
        ->and($integration->webhook_secret_token)
        ->toBe($secretToken);
});
