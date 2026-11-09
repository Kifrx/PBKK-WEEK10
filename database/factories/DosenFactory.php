<?php

namespace Database\Factories;

use App\Models\Departemen;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nip' => fake()->unique()->numerify('19################'),
            'nama' => fake('id_ID')->name(),
            'email' => fake()->unique()->bothify('dosen.????.####@its.ac.id'),
            'departemen_id' => Departemen::factory(),
        ];
    }
}
