<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use SergiX44\Nutgram\Nutgram;

class TelegramBotApiProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[\Override]
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->resolving(Nutgram::class, function (Nutgram $bot, Application $app): void {
            $routesPath = $this->app->basePath('routes/telegram.php');
            if (! file_exists($routesPath)) {
                throw new \RuntimeException('Telegram routes file not found: '.$routesPath);
            }

            require $routesPath;
        });
    }
}
