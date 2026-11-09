@extends('layouts.public')
@section('title', '404 — Halaman Tidak Ditemukan')
@section('content')

{{-- ═══ HERO — pink ═══ --}}
<div class="hero-block" style="background: var(--pink);">
    <div class="wrap" style="text-align: center;">
        <div style="font-family: 'Space Grotesk', sans-serif; font-size: clamp(6rem, 20vw, 12rem); font-weight: 700; letter-spacing: -0.06em; line-height: 1; color: rgba(255,255,255,0.25);">
            404
        </div>
    </div>
</div>

{{-- ═══ MESSAGE — cream ═══ --}}
<div style="background: var(--cream); padding: var(--s16) 0 var(--s20); text-align: center;">
    <div class="wrap">
        <div class="pill pill-neutral mb-5" style="display: inline-flex;">Halaman Tidak Ditemukan</div>
        <h1 style="font-size: clamp(1.5rem, 4vw, 2.5rem); margin-bottom: var(--s4);">Hmm, halaman ini<br>tidak ada.</h1>
        <p style="max-width: 400px; margin: 0 auto; font-size: 0.95rem; line-height: 1.8; color: var(--ink-mid); margin-bottom: var(--s8);">
            URL yang Anda tuju tidak tersedia atau telah dipindahkan. Kembali ke beranda portal akademis ITS.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: var(--s3); justify-content: center;">
            <a href="{{ route('home') }}" class="btn btn-yellow btn-lg">
                <i class="bi bi-house-door-fill"></i> Kembali ke Home
            </a>
            <a href="{{ route('mahasiswa.detail', ['nrp' => '5025241197']) }}" class="btn btn-outline-ink">
                <i class="bi bi-person-badge"></i> Profil Mahasiswa
            </a>
        </div>
    </div>
</div>

@endsection
