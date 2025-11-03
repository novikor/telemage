<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class IntegrationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General')->schema([
                    TextEntry::make('title'),
                    TextEntry::make('user.name')
                        ->label('Merchant')
                        ->visible(fn () => Auth::user()->type->isAdmin()),
                    TextEntry::make('magento_base_url'),
                    TextEntry::make('store_code'),
                ]),
                Section::make('API')->schema([
                    TextEntry::make('bot_token')->label('Telegram Bot Token'),
                    TextEntry::make('jwe_secret')->label('JWE Secret')->copyable()->copyMessage('Copied!'),
                ]),
            ]);
    }
}
