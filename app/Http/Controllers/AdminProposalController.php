<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminProposalController extends Controller
{
    /**
     * Tampilkan seluruh proposal mahasiswa untuk ditinjau oleh Dosen / Asisten Dosen.
     */
    public function index()
    {
        $proposals = Proposal::with('user')->latest()->get();

        return view('admin.proposals.index', compact('proposals'));
    }

    /**
     * Form peninjauan proposal dan penilaian (khusus Dosen).
     */
    public function show(Proposal $proposal)
    {
        return view('admin.proposals.show', compact('proposal'));
    }

    /**
     * Simpan review dan nilai proposal.
     * Hanya dosen yang boleh mengisi nilai (dilindungi Gate 'nilai-proposal').
     */
    public function updateGrade(Request $request, Proposal $proposal)
    {
        // Otorisasi Gate global
        Gate::authorize('nilai-proposal');

        $validated = $request->validate([
            'nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'catatan_review' => ['nullable', 'string'],
        ]);

        $proposal->update($validated);

        return redirect()->route('admin.proposals.index')
            ->with('status', "Nilai untuk proposal '{$proposal->judul}' berhasil disimpan!");
    }

    /**
     * Simpan review / feedback oleh Asisten Dosen (tanpa nilai angka).
     */
    public function updateReview(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            'catatan_review' => ['required', 'string'],
        ]);

        $proposal->update($validated);

        return redirect()->route('admin.proposals.index')
            ->with('status', "Catatan review untuk proposal '{$proposal->judul}' berhasil ditambahkan!");
    }
}
