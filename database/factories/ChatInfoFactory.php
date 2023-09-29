<?php

namespace Database\Factories;

use App\Models\ChatInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatInfo>
 */
class ChatInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user_1' => $this->faker->unique()->name(),
            'id_user_2' => $this->faker->name(),
            'MES_type' => 'Private'
        ];
    }
}
