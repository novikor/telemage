<?php

declare(strict_types=1);

namespace App\Enums;

enum UserType: string
{
    case ADMIN = 'admin';
    case MERCHANT = 'merchant';

    public function isAdmin(): bool
    {
        return $this === self::ADMIN;
    }
}
