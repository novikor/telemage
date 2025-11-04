<?php

declare(strict_types=1);

namespace App\Auth\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CreatePassword extends ResetPassword
{
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Password Creation Notification'))
            ->line(Lang::get('You are receiving this email because your email address has been registered in the service, and the account password must be created.'))
            ->action(Lang::get('Create Password'), $url)
            ->line(Lang::get('This password creation link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get('If you did not request a registration, no further action is required.'));
    }
}
