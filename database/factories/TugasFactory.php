<?php

namespace Database\Factories;

use App\Models\Dosen;
use Illuminate\Database\Eloquent\Factories\Factory;

class TugasFactory extends Factory
{
    public function definition(): array
    {
        return [
            'judul' => fake()->randomElement(['Analisis', 'Implementasi', 'Evaluasi']).' '.fake()->randomElement([
                'Sistem Rekomendasi', 'Klasifikasi Citra', 'Agen Percakapan', 'Pencarian Semantik', 'Prediksi Data',
            ]),
            'deskripsi' => 'Susun laporan dan sertakan hasil pengujian serta tautan repositori proyek.',
            'dosen_id' => Dosen::factory(),
            'departemen_id' => fn (array $attributes) => Dosen::findOrFail($attributes['dosen_id'])->departemen_id,
            'deadline' => fake()->dateTimeBetween('-2 weeks', '+2 months')->format('Y-m-d'),
            'is_active' => fake()->boolean(90),
        ];
    }
}
