<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Integration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TelegramUser>
 */
class TelegramUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'integration_id' => Integration::factory(),
            'chat_id' => fake()->randomNumber(5, true),
            'customer_id' => fake()->randomNumber(5, true),
        ];
    }
}
