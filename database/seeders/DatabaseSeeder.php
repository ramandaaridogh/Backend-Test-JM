<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        User::factory(10)->create();
        Unit::factory(10)->has(Employee::factory()->count(10), 'employees')->create();
    }
}
