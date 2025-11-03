<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IntegrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General')->schema([
                    TextInput::make('title')
                        ->label('Integration Title')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('magento_base_url')
                        ->label('Magento Base URL')
                        ->required()
                        ->url()
                        ->maxLength(255),
                    TextInput::make('store_code')
                        ->label('Store Code')
                        ->maxLength(50),
                ]),
                Section::make('API')->schema([
                    TextInput::make('bot_token')
                        ->label('Telegram Bot Token')
                        ->required()
                        ->maxLength(255),
                ]),
            ]);
    }
}
