<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\Filament\DashboardPanelProvider;
use App\Providers\FilamentServiceProvider;
use App\Providers\FortifyServiceProvider;

return [
    AppServiceProvider::class,
    FilamentServiceProvider::class,
    DashboardPanelProvider::class,
    FortifyServiceProvider::class,
];
