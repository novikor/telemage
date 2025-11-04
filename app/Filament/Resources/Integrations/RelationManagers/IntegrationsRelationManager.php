<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations\RelationManagers;

use App\Filament\Resources\Integrations\IntegrationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class IntegrationsRelationManager extends RelationManager
{
    protected static string $relationship = 'Integrations';

    protected static ?string $relatedResource = IntegrationResource::class;

    public function table(Table $table): Table
    {
        $table
            ->headerActions([
                CreateAction::make(),
            ]);
        $table->getColumn('user.name')->visible(false);

        return $table;
    }
}
