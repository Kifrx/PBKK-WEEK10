<?php

namespace Database\Factories;

use App\Models\Departemen;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nrp' => fake()->unique()->numerify('50########'),
            'nama' => fake('id_ID')->name(),
            'email' => fake()->unique()->bothify('mhs.????.####@student.its.ac.id'),
            'departemen_id' => Departemen::factory(),
            'is_active' => fake()->boolean(85),
        ];
    }
}
