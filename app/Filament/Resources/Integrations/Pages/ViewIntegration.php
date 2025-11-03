<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\Pages;

use App\Filament\Resources\Integrations\IntegrationResource;
use App\Models\Integration;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;

/**
 * @property Integration $record
 */
class ViewIntegration extends ViewRecord
{
    protected static string $resource = IntegrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->slideOver(),
            DeleteAction::make()->requiresConfirmation(),
            ForceDeleteAction::make()->requiresConfirmation(),
            RestoreAction::make(),
            Action::make('regenerate_secret')
                ->label('Regenerate JWT Secret')
                ->requiresConfirmation()
                ->modalDescription('This will generate a new JWT secret for the Integration. All existing Telegram users will need to re-authenticate.')
                ->action(function (): void {
                    $this->record->jwe_secret = Str::random(64);
                    $this->record->save();
                    Notification::make()->success()->title('JWT secret regenerated successfully.')->send();
                }),
        ];
    }
}
