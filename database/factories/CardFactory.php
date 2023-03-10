<?php

namespace Database\Factories;

use App\Models\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'column_id' => Column::factory(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'position' => $this->faker->randomDigitNotZero(),
        ];
    }
}
