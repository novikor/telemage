<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users;

use App\Enums\UserType;
use App\Filament\Resources\Integrations\RelationManagers\IntegrationsRelationManager;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $modelLabel = 'Merchant';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    #[\Override]
    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    #[\Override]
    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
    }

    #[\Override]
    public static function form(Schema $schema): Schema
    {
        return UserForm::configure($schema);
    }

    #[\Override]
    public static function getRelations(): array
    {
        return [
            IntegrationsRelationManager::class,
        ];
    }

    #[\Override]
    public static function getEloquentQuery(): Builder
    {
        /** @var Builder|User $builder */
        $builder = parent::getEloquentQuery();

        return $builder->whereType(UserType::MERCHANT);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
        ];
    }
}
