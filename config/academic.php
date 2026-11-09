<?php

use App\Models\Departemen;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;

return [
    'mahasiswa' => [
        'label' => 'Mahasiswa',
        'model' => Mahasiswa::class,
        'search' => ['nama', 'nrp'],
        'fields' => ['nrp' => 'NRP', 'nama' => 'Nama', 'email' => 'Email', 'departemen_id' => 'Departemen', 'is_active' => 'Status'],
    ],
    'dosen' => [
        'label' => 'Dosen',
        'model' => Dosen::class,
        'search' => ['nama', 'nip'],
        'fields' => ['nip' => 'NIP', 'nama' => 'Nama', 'email' => 'Email', 'departemen_id' => 'Departemen'],
    ],
    'tugas' => [
        'label' => 'Tugas',
        'model' => Tugas::class,
        'search' => ['judul'],
        'fields' => ['judul' => 'Judul', 'deskripsi' => 'Deskripsi', 'departemen_id' => 'Departemen', 'dosen_id' => 'Dosen', 'deadline' => 'Tenggat', 'is_active' => 'Status'],
    ],
    'departemen' => [
        'label' => 'Departemen',
        'model' => Departemen::class,
        'search' => ['nama', 'kode'],
        'fields' => ['kode' => 'Kode', 'nama' => 'Nama'],
    ],
];
