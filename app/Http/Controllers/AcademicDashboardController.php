<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use Illuminate\View\View;

class AcademicDashboardController extends Controller
{
    public function __invoke(): View
    {
        $statistics = [
            ['label' => 'Total Mahasiswa', 'count' => Mahasiswa::count(), 'icon' => 'bi bi-mortarboard', 'theme' => 'success', 'route' => 'admin.mahasiswa.index'],
            ['label' => 'Total Staf Dosen', 'count' => Dosen::count(), 'icon' => 'bi bi-person-badge', 'theme' => 'primary', 'route' => 'admin.dosen.index'],
            ['label' => 'Total Tugas Aktif', 'count' => Tugas::where('is_active', true)->where('deadline', '>=', today()->toDateString())->count(), 'icon' => 'bi bi-list-task', 'theme' => 'secondary', 'route' => 'admin.tugas.index'],
        ];

        return view('academic.dashboard', compact('statistics'));
    }
}
