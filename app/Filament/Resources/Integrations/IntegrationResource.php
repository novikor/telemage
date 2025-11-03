<?php

declare(strict_types=1);

namespace App\Filament\Resources\Integrations;

use App\Filament\Resources\Integrations\Pages\CreateIntegration;
use App\Filament\Resources\Integrations\Pages\ListIntegrations;
use App\Filament\Resources\Integrations\Pages\ViewIntegration;
use App\Filament\Resources\Integrations\Schemas\IntegrationForm;
use App\Filament\Resources\Integrations\Schemas\IntegrationInfolist;
use App\Filament\Resources\Integrations\Tables\IntegrationsTable;
use App\Models\Integration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class IntegrationResource extends Resource
{
    protected static ?string $model = Integration::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return IntegrationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return IntegrationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return IntegrationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        /** @var Builder|Integration $builder */
        $builder = parent::getEloquentQuery();

        return $builder->ofUser(Auth::user())->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIntegrations::route('/'),
            'create' => CreateIntegration::route('/create'),
            'view' => ViewIntegration::route('/{record}'),
        ];
    }
}
