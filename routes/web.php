<?php

use App\Http\Controllers\AcademicDashboardController;
use App\Http\Controllers\AcademicDataController;
use App\Http\Controllers\AdminProposalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return $request->user() ? to_route('dashboard') : redirect('/login');
})->name('home.entry');

/*
|--------------------------------------------------------------------------
| Rute Terautentikasi (Breeze Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function (Request $request, PageController $pages) {
        if ($request->user()->hasAnyRole(['admin', 'staf'])) {
            return to_route('admin.dashboard');
        }

        if ($request->user()->can('kelola-portal')) {
            return redirect()->route('admin.proposals.index');
        }

        return $pages->index($request);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'cek.peran:mahasiswa'])->group(function () {
    Route::get('/beranda', [PageController::class, 'index'])->name('beranda');
    Route::get('/home', [PageController::class, 'index'])->name('home');
    Route::get('/profil-mahasiswa', [PageController::class, 'profilMahasiswa'])->name('profil.mahasiswa');
    Route::get('/ide-agent', [PageController::class, 'ideAgent'])->name('ide.agent');
    Route::get('/mahasiswa/{nrp}', [PageController::class, 'mahasiswa'])
        ->where('nrp', '^[0-9]{10}$')
        ->name('mahasiswa.detail');
    Route::get('/agent/{tema?}', [PageController::class, 'agent'])->name('agent');
    Route::get('/hitung-ipk/{ip1}/{ip2}', [PageController::class, 'hitungIpk'])->name('hitung.ipk');

    /*
    |--------------------------------------------------------------------------
    | 2. Area Mahasiswa: Mengisi & Menyunting Rencana Proyek Kelompok AI
    |    Tantangan 1: Rate Limiting kustom (maksimal 3 proposal / menit)
    |--------------------------------------------------------------------------
    */
    Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('/proposals/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/proposals', [ProposalController::class, 'store'])
        ->middleware('throttle:3,1')
        ->name('proposals.store');
    Route::get('/proposals/{proposal}/edit', [ProposalController::class, 'edit'])->name('proposals.edit');
    Route::put('/proposals/{proposal}', [ProposalController::class, 'update'])->name('proposals.update');
    Route::delete('/proposals/{proposal}', [ProposalController::class, 'destroy'])->name('proposals.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. Area Dosen/Asisten: Review proyek AI mahasiswa
|    Hanya bisa diakses oleh user dengan role 'dosen' atau 'asdos'
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'cek.peran:dosen,asdos'])
    ->prefix('review')
    ->name('admin.')
    ->group(function () {
        Route::get('/proposals', [AdminProposalController::class, 'index'])->name('proposals.index');
        Route::get('/proposals/{proposal}', [AdminProposalController::class, 'show'])->name('proposals.show');
        Route::patch('/proposals/{proposal}/grade', [AdminProposalController::class, 'updateGrade'])->name('proposals.grade');
        Route::patch('/proposals/{proposal}/review', [AdminProposalController::class, 'updateReview'])->name('proposals.review');
    });

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin|staf'])->group(function () {
    Route::get('/dashboard', AcademicDashboardController::class)
        ->middleware('permission:lihat-data')->name('dashboard');

    foreach (array_keys(config('academic')) as $module) {
        Route::prefix($module)->name($module.'.')->group(function () use ($module) {
            Route::get('/', [AcademicDataController::class, 'index'])
                ->defaults('module', $module)->middleware('permission:lihat-data')->name('index');
            Route::get('/create', [AcademicDataController::class, 'create'])
                ->defaults('module', $module)->middleware('permission:tambah-data')->name('create');
            Route::post('/', [AcademicDataController::class, 'store'])
                ->defaults('module', $module)->middleware('permission:tambah-data')->name('store');
            Route::get('/{record}/edit', [AcademicDataController::class, 'edit'])
                ->whereNumber('record')->defaults('module', $module)->middleware('permission:edit-data')->name('edit');
            Route::put('/{record}', [AcademicDataController::class, 'update'])
                ->whereNumber('record')->defaults('module', $module)->middleware('permission:edit-data')->name('update');
            Route::delete('/{record}', [AcademicDataController::class, 'destroy'])
                ->whereNumber('record')->defaults('module', $module)->middleware('permission:hapus-data')->name('destroy');
        });
    }
});
