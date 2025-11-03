<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

trait ScopedByUser
{
    protected function scopeOfUser(Builder $query, User $user): void
    {
        if (! $user->type->isAdmin()) {
            $query->where('user_id', $user->getAuthIdentifier());
        }
    }
}
