<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\Database\Seeder;

class AcademicDataSeeder extends Seeder
{
    public function run(): void
    {
        $departments = collect([
            'IF' => 'Teknik Informatika',
            'SI' => 'Sistem Informasi',
            'TE' => 'Teknik Elektro',
            'TK' => 'Teknik Komputer',
            'TI' => 'Teknologi Informasi',
        ])->map(fn ($name, $code) => Departemen::firstOrCreate(['kode' => $code], ['nama' => $name]));

        if (! Dosen::exists()) {
            Dosen::factory(15)->state(fn () => ['departemen_id' => $departments->random()->id])->create();
        }

        if (! Mahasiswa::exists()) {
            Mahasiswa::factory(40)->state(fn () => ['departemen_id' => $departments->random()->id])->create();
        }

        if (! Tugas::exists()) {
            $lecturers = Dosen::all(['id', 'departemen_id']);
            Tugas::factory(20)->state(function () use ($lecturers) {
                $lecturer = $lecturers->random();

                return ['dosen_id' => $lecturer->id, 'departemen_id' => $lecturer->departemen_id];
            })->create();
        }
    }
}
