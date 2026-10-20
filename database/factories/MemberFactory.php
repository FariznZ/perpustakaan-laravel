<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'member_id' => 'ANG' . fake()->unique()->numberBetween(1000, 9999),
            'name' => fake()->name(),
            'nim' => fake()->unique()->numerify('########'),
            'class_name' => fake()->randomElement(['TI-1A', 'TI-1B', 'TI-2A', 'TI-2B', 'SI-1A', 'SI-2A']),
            'phone' => '08' . fake()->numerify('##########'),
            'email' => fake()->unique()->safeEmail(),
            'status' => fake()->randomElement(['Aktif', 'Nonaktif']),
        ];
    }
}