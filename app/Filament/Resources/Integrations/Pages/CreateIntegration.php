<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\Pages;

use App\Filament\Resources\Integrations\IntegrationResource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\Str;

class CreateIntegration extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = IntegrationResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Merchant')
                ->description('Please select the merchant you want to create an integration for.')
                ->visible(fn () => auth()->user()->type->isAdmin())
                ->schema([
                    Select::make('user_id')
                        ->label('Merchant')
                        ->required()
                        ->relationship(name: 'user', titleAttribute: 'name'),
                ]),
            Step::make('Magento Integration')
                ->description('Please enter your Magento integration details.')
                ->schema([
                    TextInput::make('title')->required()->maxLength(255),
                    TextInput::make('magento_base_url')->url()->required()->label('Magento Base URL')->maxLength(255),
                    TextInput::make('store_code')->label('Store Code (optional)')->maxLength(50),
                ]),
            Step::make('Telegram Integration')
                ->description('Please enter your Telegram integration details.')
                ->schema([
                    TextInput::make('bot_token')->required()->label('Telegram Bot Token from @BotFather')->maxLength(255),
                ]),
        ];
    }

    #[\Override]
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['user_id']) && ! auth()->user()->type->isAdmin()) {
            $data['user_id'] = auth()->id();
        }

        return [
            ...$data,
            'jwe_secret' => Str::random(64),
        ];
    }
}
