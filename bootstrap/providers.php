<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\Filament\DashboardPanelProvider;
use App\Providers\FilamentServiceProvider;
use App\Providers\FortifyServiceProvider;
use App\Providers\TelegramBotApiProvider;
use App\Providers\TelescopeServiceProvider;

return [
    AppServiceProvider::class,
    FilamentServiceProvider::class,
    DashboardPanelProvider::class,
    FortifyServiceProvider::class,
    TelegramBotApiProvider::class,
    TelescopeServiceProvider::class,
];
