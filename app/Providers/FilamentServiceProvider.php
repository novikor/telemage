<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[\Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(PanelsRenderHook::BODY_END, fn (): string => Blade::render('@fluxScripts'));
        FilamentView::registerRenderHook(PanelsRenderHook::HEAD_END, fn (): string => Blade::render('@fluxAppearance'));
    }
}
