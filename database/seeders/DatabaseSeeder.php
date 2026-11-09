<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            AcademicDataSeeder::class,
        ]);

        // 1. Akun Dosen
        $dosen = User::updateOrCreate(
            ['email' => 'dosen@its.ac.id'],
            [
                'name' => 'Prof. Dr. Ir. Budi Santoso, M.Kom.',
                'role' => 'dosen',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Akun Asisten Dosen (Asdos)
        $asdos = User::updateOrCreate(
            ['email' => 'asdos@its.ac.id'],
            [
                'name' => 'Ahmad Fauzi (Asdos PBKK)',
                'role' => 'asdos',
                'password' => bcrypt('password'),
            ]
        );

        // 3. Akun Mahasiswa 1
        $mhs1 = User::updateOrCreate(
            ['email' => 'mahasiswa1@mhs.its.ac.id'],
            [
                'name' => 'Zikri Muhammad (Mahasiswa 1)',
                'role' => 'mahasiswa',
                'password' => bcrypt('password'),
            ]
        );

        // 4. Akun Mahasiswa 2
        $mhs2 = User::updateOrCreate(
            ['email' => 'mahasiswa2@mhs.its.ac.id'],
            [
                'name' => 'Siti Nurhaliza (Mahasiswa 2)',
                'role' => 'mahasiswa',
                'password' => bcrypt('password'),
            ]
        );

        // Contoh Data Proposal Proyek Kelompok AI
        \App\Models\Proposal::updateOrCreate(
            ['judul' => 'Sistem Deteksi Retinopati Diabetik Berbasis CNN dan Mobile App'],
            [
                'user_id' => $mhs1->id,
                'kelompok' => 'Kelompok AI-01 (VisionLab)',
                'deskripsi' => 'Pengembangan model deteksi dini penyakit mata diabetes menggunakan arsitektur EfficientNet terintegrasi dengan portal telemedicine.',
                'nilai' => 88,
                'catatan_review' => 'Rencana arsitektur dan timeline implementasi sudah sangat matang. Silakan lanjut ke tahap prototipe.',
            ]
        );

        \App\Models\Proposal::updateOrCreate(
            ['judul' => 'Chatbot Akademik Kampus Berbasis Retrieval-Augmented Generation (RAG)'],
            [
                'user_id' => $mhs2->id,
                'kelompok' => 'Kelompok AI-02 (NLP Team)',
                'deskripsi' => 'Agen cerdas pemandu informasi akademik mahasiswa ITS menggunakan model LLM lokal dan basis pengetahuan peraturan akademik ITS.',
                'nilai' => null,
                'catatan_review' => 'Perjelas batas dataset silabus dan skema evaluasi respons LLM.',
            ]
        );
    }
}
