<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartemenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'kode' => fake()->unique()->bothify('DEP-###'),
            'nama' => 'Departemen '.fake('id_ID')->unique()->city(),
        ];
    }
}
