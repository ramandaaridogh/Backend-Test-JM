<?php

namespace Database\Factories;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::query()->inRandomOrder()->first();
        return [
            'name' => $this->faker->jobTitle,
            'status' => rand(0, 1),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }

}
