<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProposalController extends Controller
{
    /**
     * Tampilkan daftar proposal proyek milik mahasiswa yang sedang login.
     */
    public function index(Request $request)
    {
        $proposals = $request->user()->proposals()->latest()->get();

        return view('proposals.index', compact('proposals'));
    }

    /**
     * Form pengajuan proposal proyek baru.
     */
    public function create()
    {
        Gate::authorize('create', Proposal::class);

        return view('proposals.create');
    }

    /**
     * Simpan proposal proyek AI (Dilindungi rate limiter 3 submit / menit).
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Proposal::class);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kelompok' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string', 'min:10'],
        ]);

        $request->user()->proposals()->create($validated);

        return redirect()->route('proposals.index')
            ->with('status', 'Proposal rencana proyek AI kelompok Anda berhasil diajukan!');
    }

    /**
     * Form edit proposal (Hanya mahasiswa pemilik proposal).
     */
    public function edit(Proposal $proposal)
    {
        Gate::authorize('update', $proposal);

        return view('proposals.edit', compact('proposal'));
    }

    /**
     * Update proposal (Otorisasi Policy: Hanya pembuat proposal).
     */
    public function update(Request $request, Proposal $proposal)
    {
        Gate::authorize('update', $proposal);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kelompok' => ['required', 'string', 'max:100'],
            'deskripsi' => ['required', 'string', 'min:10'],
        ]);

        $proposal->update($validated);

        return redirect()->route('proposals.index')
            ->with('status', 'Judul dan rencana proyek kelompok Anda berhasil diperbarui!');
    }

    /**
     * Hapus proposal (Hanya pembuat proposal).
     */
    public function destroy(Proposal $proposal)
    {
        Gate::authorize('delete', $proposal);

        $proposal->delete();

        return redirect()->route('proposals.index')
            ->with('status', 'Proposal proyek berhasil dihapus.');
    }
}
