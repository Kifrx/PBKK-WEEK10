@extends('layouts.public')
@section('title', 'Profil Mahasiswa — ' . $mhs['nama'])
@section('content')

{{-- ═══ HERO — warm yellow ═══ --}}
<div class="hero-block" style="background: var(--yellow);">
    <div class="wrap">
        <div class="pill pill-white-strong mb-5">
            <i class="bi bi-person-badge-fill"></i> Profil Mahasiswa ITS
        </div>

        <div style="display: flex; align-items: flex-end; gap: var(--s6); flex-wrap: wrap;">
            <div class="avatar" style="background: var(--ink); color: var(--yellow); width: 100px; height: 100px; font-size: 2.2rem; border-radius: var(--r-xl);">
                SZ
            </div>
            <div>
                <h1 class="t-hero" style="color: var(--ink); margin-bottom: var(--s2);">{{ $mhs['nama'] }}</h1>
                <p style="color: rgba(26,26,18,0.60); font-size: 0.95rem; margin-bottom: var(--s3);">
                    {{ $mhs['prodi'] }} &middot; {{ $mhs['departemen'] }}
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: var(--s2);">
                    <span class="chip ink"><i class="bi bi-hash"></i> {{ $mhs['nrp'] }}</span>
                    <span class="chip ink"><i class="bi bi-check-circle-fill" style="color: var(--lime);"></i> {{ $mhs['status'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ CONTENT — two column ═══ --}}
<div style="background: var(--cream); padding: var(--s16) 0;">
    <div class="wrap">
        <x-status-banner type="primary" title="Status Akademik Mahasiswa Aktif" icon="bi bi-patch-check-fill">
            Status mahasiswa terverifikasi aktif pada semester berjalan di Sistem Informasi Akademik ITS.
        </x-status-banner>

        <div class="row g-5">

            {{-- LEFT: stat card --}}
            <div class="col-12 col-lg-4">
                <div class="card card-p" style="display: flex; flex-direction: column; gap: var(--s6);">

                    {{-- Big IPK --}}
                    <div style="text-align: center; padding: var(--s6) 0;">
                        <div class="t-label mb-2" style="color: var(--ink-soft);">IPK Proyeksi</div>
                        <div class="t-stat" style="color: var(--ink);">{{ $mhs['ipk_proyeksi'] }}</div>
                        <div style="margin-top: var(--s3);">
                            <span class="chip lime"><i class="bi bi-award-fill"></i> Dengan Pujian</span>
                        </div>
                    </div>

                    <hr class="divider" style="margin: 0;">

                    {{-- Info blocks using <x-info-card> --}}
                    <div style="display: flex; flex-direction: column; gap: var(--s3);">
                        <x-info-card label="Fokus Pengembangan" :value="$mhs['peran_tim']" icon="bi bi-star-fill" />
                        <x-info-card label="Email Mahasiswa" :value="$mhs['email']" icon="bi bi-envelope-fill" />
                        <x-info-card label="Departemen / Fakultas" :value="$mhs['departemen'] . ' · ' . $mhs['fakultas']" icon="bi bi-geo-alt-fill" />
                        <x-info-card label="Angkatan" :value="$mhs['angkatan']" icon="bi bi-calendar-event" />
                    </div>

                    <a href="{{ route('home') }}" class="btn btn-outline-ink btn-full">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            {{-- RIGHT: details --}}
            <div class="col-12 col-lg-8">
                <div class="card card-p" style="display: flex; flex-direction: column; gap: var(--s8);">

                    {{-- Academic info using <x-info-card> --}}
                    <div>
                        <div style="display: flex; align-items: center; gap: var(--s3); margin-bottom: var(--s5);">
                            <div class="icon-box lime" style="width: 36px; height: 36px; font-size: 15px;"><i class="bi bi-journal-text"></i></div>
                            <h2 class="t-subhead">Informasi Akademis</h2>
                        </div>
                        <div class="row g-3">
                            <div class="col-6">
                                <x-info-card label="Departemen" :value="$mhs['departemen']" icon="bi bi-building" />
                            </div>
                            <div class="col-6">
                                <x-info-card label="Angkatan" :value="$mhs['angkatan']" icon="bi bi-calendar-check" />
                            </div>
                            <div class="col-12">
                                <x-info-card label="Fakultas" :value="$mhs['fakultas']" icon="bi bi-mortarboard" />
                            </div>
                        </div>
                    </div>

                    <hr class="divider" style="margin: 0;">

                    {{-- Bio --}}
                    <div>
                        <div class="t-label mb-3">Biografi</div>
                        <p class="t-body-lg">{{ $mhs['bio'] }}</p>
                    </div>

                    <hr class="divider" style="margin: 0;">

                    {{-- Matkul --}}
                    <div>
                        <div class="t-label mb-3">Mata Kuliah Semester Ini</div>
                        <div style="display: flex; flex-wrap: wrap; gap: var(--s2);">
                            @foreach($mhs['matkul'] as $mk)
                                <span class="tag">
                                    <i class="bi bi-book" style="color: var(--lime); font-size: 11px;"></i> {{ $mk }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
