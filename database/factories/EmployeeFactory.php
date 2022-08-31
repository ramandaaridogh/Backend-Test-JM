<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'nik' => $this->faker->unique()->numberBetween(1000000000000000, 9999999999999999),
            'name' => $this->faker->name,
            'position_name' => $this->faker->jobTitle,
            'date_of_birth' => $this->faker->date('Y-m-d', 'now'),
            'place_of_birth' => $this->faker->city(),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ];
    }
}
