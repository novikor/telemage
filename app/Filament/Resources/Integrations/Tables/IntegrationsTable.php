<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class IntegrationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Merchant')
                    ->searchable()
                    ->visible(fn () => Auth::user()->type->isAdmin()),
                TextColumn::make('magento_base_url')
                    ->label('URL')
                    ->searchable(),
                TextColumn::make('store_code')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('merchant')
                    ->relationship('user', 'name')
                    ->visible(fn () => Auth::user()->type->isAdmin())
                    ->searchable()
                    ->preload(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
            ]);
    }
}
