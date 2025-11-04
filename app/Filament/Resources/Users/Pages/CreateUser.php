<?php

declare(strict_types=1);

namespace App\Filament\Resources\Users\Pages;

use App\Auth\Notifications\CreatePassword as CreatePasswordNotification;
use App\Enums\UserType;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Wizard\Step;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Register a new Merchant';

    use CreateRecord\Concerns\HasWizard;

    protected function getSteps(): array
    {
        return [
            Step::make('Merchant')
                ->description('Please enter the merchant (Magento store owner) details.')
                ->schema(UserForm::configure(...)),
            Step::make('Reset password Email')
                ->schema([
                    Checkbox::make('should_send_password_email')
                        ->label('Send password reset email to merchant after the registration?')
                        ->default(true),
                ]),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = UserType::MERCHANT;
        $data['email_verified_at'] = now();
        // We can't leave the password empty, so we generate a random one
        // The merchant will have reset it anyway
        $data['password'] = Str::random(64);

        return $data;
    }

    protected function handleRecordCreation(array $data): User
    {
        /** @var User $user */
        $user = static::getModel()::create($data);
        if (filled($data['should_send_password_email'])) {
            $user->notify(new CreatePasswordNotification(Password::broker()->createToken($user)));
        }

        return $user;
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Merchant registered, password creation link sent';
    }
}
