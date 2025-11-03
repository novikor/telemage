<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\Integration;
use App\Models\User;
use Illuminate\Database\Seeder;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->where('type', UserType::STORE_OWNER)->each(function (User $user): void {
            Integration::factory()->count(4)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
