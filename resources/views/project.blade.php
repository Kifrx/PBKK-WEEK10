@extends('layouts.public')
@section('title', 'Platform Agentic AI — Syah Amin Zikri')
@section('content')

@php
    $darkMode = request('mode') === 'dark' || (isset($darkMode) && $darkMode);
@endphp

@if($darkMode)
<style>
    .theme-dark {
        background-color: #121316 !important;
        color: #e2e8f0 !important;
    }
    .theme-dark .hero-block {
        background: #181A20 !important;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .theme-dark div[style*="background: var(--white)"],
    .theme-dark div[style*="background: var(--cream)"] {
        background: #121316 !important;
    }
    .theme-dark .card,
    .theme-dark .step-card {
        background: #1c1f26 !important;
        border-color: rgba(255,255,255,0.1) !important;
        color: #f1f5f9 !important;
    }
    .theme-dark .t-heading,
    .theme-dark .t-subhead,
    .theme-dark h1,
    .theme-dark h2,
    .theme-dark h3,
    .theme-dark h4 {
        color: #f8fafc !important;
    }
    .theme-dark .t-body,
    .theme-dark .t-body-lg,
    .theme-dark p {
        color: #94a3b8 !important;
    }
    .theme-dark .pill-white-strong {
        background: rgba(255,255,255,0.12) !important;
        color: #f8fafc !important;
        border-color: rgba(255,255,255,0.15) !important;
    }
</style>
@endif

<div class="{{ $darkMode ? 'theme-dark' : 'theme-light' }}">

{{-- ═══ HERO — coral/orange (or dark in dark mode) ═══ --}}
<div class="hero-block" style="background: {{ $darkMode ? '#181A20' : 'var(--coral)' }};">
    <div class="wrap">
        <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: var(--s3); margin-bottom: var(--s5);">
            <div class="pill pill-white-strong">
                <i class="bi bi-cpu-fill"></i> Agentic AI Platform
                @if($hasTema) · <span style="opacity:.7;">{{ $tema }}</span> @endif
            </div>

            <div>
                @if($darkMode)
                    <a href="{{ request()->fullUrlWithQuery(['mode' => null]) }}" class="btn btn-sm btn-white" style="font-size: 0.8rem;">
                        <i class="bi bi-sun-fill" style="color: var(--orange);"></i> Mode Normal
                    </a>
                @else
                    <a href="{{ request()->fullUrlWithQuery(['mode' => 'dark']) }}" class="btn btn-sm btn-ink" style="font-size: 0.8rem;">
                        <i class="bi bi-moon-stars-fill"></i> Mode Dark
                    </a>
                @endif
            </div>
        </div>

        <h1 class="t-display mb-5" style="color: var(--white); max-width: 700px;">
            @if($hasTema)
                Personalized Career<br>Application Agent.
            @else
                General Assistant<br>Agent.
            @endif
        </h1>

        <p style="color: rgba(255,255,255,0.70); font-size: 1rem; max-width: 520px; line-height: 1.75;">
            @if($hasTema)
                Career Application Agent cerdas yang menganalisis profil pengguna, merekomendasikan peluang kerja paling relevan, dan menyesuaikan materi lamaran secara personal.
            @else
                Asisten serbaguna berbasis AI yang dirancang untuk otomasi analisis, panduan karier, dan berbagai kebutuhan intelijen adaptif.
            @endif
        </p>
    </div>
</div>


{{-- ═══ CONTENT ═══ --}}
@if($hasTema)

    {{-- HOW IT WORKS — white bg --}}
    <div style="background: var(--white); padding: var(--s16) 0;">
        <div class="wrap">
            <div class="row align-items-center g-8">
                <div class="col-12 col-lg-5">
                    <div class="pill pill-coral mb-4"><i class="bi bi-lightbulb-fill"></i> Konsep Sistem</div>
                    <h2 class="t-heading mt-3 mb-4">Bagaimana Agent Ini Bekerja?</h2>
                    <a href="{{ route('agent', ['tema' => $tema]) }}" class="btn btn-yellow mt-2">
                        Mode Aktif: {{ $tema }} <i class="bi bi-check-circle-fill"></i>
                    </a>
                </div>
                <div class="col-12 col-lg-7">
                    <p class="t-body-lg" style="margin-bottom: var(--s4);">
                        Sistem ini merupakan <strong>AI agent</strong> yang membantu pencari kerja menemukan peluang pekerjaan yang paling sesuai dengan profil mereka. Pengguna memberikan informasi mengenai latar belakang pendidikan, keterampilan, pengalaman, proyek, dan preferensi karier.
                    </p>
                    <p class="t-body-lg">
                        Agent menganalisis berbagai lowongan, membandingkannya dengan profil pengguna, lalu menyesuaikan materi lamaran secara personal. Sistem ini berfungsi sebagai <strong>career application agent</strong> — bukan sekadar pencari lowongan atau pembuat CV.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- TUJUAN — cream bg --}}
    <div style="background: var(--cream); padding: var(--s16) 0;">
        <div class="wrap">
            <div style="margin-bottom: var(--s10);">
                <div class="pill pill-orange mb-3"><i class="bi bi-crosshair2"></i> Tujuan Proyek</div>
                <h2 class="t-heading mt-3 mb-2">Nilai & Manfaat Utama</h2>
                <p class="t-body">Empat tujuan pengembangan Personalized Agentic AI ini.</p>
            </div>

            <div class="row g-4">
                @foreach([
                    ['lime',   'bi-compass-fill',           'Efisiensi Seleksi Manual',         'Mengurangi proses pencarian dan seleksi lowongan yang dilakukan secara manual.'],
                    ['purple', 'bi-bullseye',                'Matching Karier Relevan',           'Membantu pengguna menemukan pekerjaan yang paling relevan dengan profil dan tujuan kariernya.'],
                    ['teal',   'bi-file-earmark-text-fill', 'Penyesuaian CV & Lamaran',          'Menyesuaikan CV dan materi lamaran berdasarkan karakteristik dan kebutuhan setiap posisi.'],
                    ['orange', 'bi-stars',                   'Rekomendasi Hyper-Personalized',   'Rekomendasi yang jauh lebih personal dibandingkan pencarian berbasis keyword konvensional.'],
                ] as [$color, $icon, $title, $desc])
                <div class="col-12 col-sm-6">
                    <div class="card card-p card-hover" style="display: flex; align-items: flex-start; gap: var(--s4); height: 100%;">
                        <div class="icon-box {{ $color }}"><i class="bi {{ $icon }}"></i></div>
                        <div>
                            <h4 class="t-subhead mb-2">{{ $title }}</h4>
                            <p class="t-body">{{ $desc }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ALUR KERJA — white bg --}}
    <div style="background: var(--white); padding: var(--s16) 0;">
        <div class="wrap">
            <div style="margin-bottom: var(--s10);">
                <div class="pill pill-neutral mb-3"><i class="bi bi-layers-fill"></i> Alur Kerja</div>
                <h2 class="t-heading mt-3 mb-2">Tahapan Proses Agent</h2>
                <p class="t-body">Empat langkah cerdas dari input profil hingga keputusan lamaran kerja.</p>
            </div>

            <div class="row g-4">
                @foreach([
                    ['01', 'Profil & Preferensi Karier',   'Input latar belakang pendidikan, skill, proyek, pengalaman, dan preferensi karier pengguna.'],
                    ['02', 'Analisis & Matching Lowongan', 'Agent menganalisis berbagai lowongan dan menentukan tingkat relevansi serta prioritas setiap peluang.'],
                    ['03', 'Penyesuaian Materi Lamaran',   'Mengidentifikasi kompetensi terbaik dan menyesuaikan CV serta dokumen lamaran secara personal.'],
                    ['04', 'Rekomendasi & Keputusan',      'Panduan berbasis AI untuk mengambil keputusan lamaran pekerjaan secara efektif.'],
                ] as [$num, $title, $desc])
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="step-card">
                        <div class="step-num">{{ $num }}</div>
                        <h4 class="t-subhead mb-2">{{ $title }}</h4>
                        <p class="t-body">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══ FORMULIR IDE AGENT (INTERAKTIF) ═══ --}}
    <div style="background: var(--cream); padding: var(--s16) 0; border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border);">
        <div class="wrap">
            <div style="max-width: 860px; margin: 0 auto;">
                <div class="pill pill-coral mb-3"><i class="bi bi-lightbulb-fill"></i> Formulir Ide Agent</div>
                <h2 class="t-heading mb-4">Ajukan / Eksplorasi Ide Agent Baru</h2>

                @if(request()->filled('nama_ide'))
                    <x-status-banner type="success" title="Ide Berhasil Diajukan!" icon="bi bi-check-circle-fill">
                        Ide agent <strong>"{{ request('nama_ide') }}"</strong> pada kategori <strong>{{ request('kategori', 'General') }}</strong> telah berhasil didaftarkan ke sistem!
                    </x-status-banner>
                @endif

                <form action="{{ url()->current() }}" method="GET" class="card card-p" style="margin-top: var(--s5);">
                    @if(request('mode') === 'dark')
                        <input type="hidden" name="mode" value="dark">
                    @endif

                    <div class="row g-4">
                        <div class="col-12 col-md-6">
                            <label for="namaIde" class="info-label" style="display: block; margin-bottom: 6px; font-weight: 700;">
                                Nama Ide Agent
                            </label>
                            <input type="text" 
                                   id="namaIde" 
                                   name="nama_ide" 
                                   value="{{ request('nama_ide') }}" 
                                   class="form-control" 
                                   placeholder="Contoh: Academic Research Copilot" 
                                   required 
                                   style="padding: 10px 14px; border-color: var(--color-border);">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="kategoriIde" class="info-label" style="display: block; margin-bottom: 6px; font-weight: 700;">
                                Kategori Bidang Agent
                            </label>
                            <select id="kategoriIde" name="kategori" class="form-select" style="padding: 10px 14px; border-color: var(--color-border);">
                                <option value="Career & Job Matching" {{ request('kategori') == 'Career & Job Matching' ? 'selected' : '' }}>Career & Job Matching</option>
                                <option value="Academic Advisory" {{ request('kategori') == 'Academic Advisory' ? 'selected' : '' }}>Academic Advisory</option>
                                <option value="Smart Automation" {{ request('kategori') == 'Smart Automation' ? 'selected' : '' }}>Smart Automation</option>
                                <option value="Data & Code Analysis" {{ request('kategori') == 'Data & Code Analysis' ? 'selected' : '' }}>Data & Code Analysis</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="deskripsiIde" class="info-label" style="display: block; margin-bottom: 6px; font-weight: 700;">
                                Deskripsi Singkat Konsep
                            </label>
                            <textarea id="deskripsiIde" 
                                      name="deskripsi" 
                                      rows="3" 
                                      class="form-control" 
                                      placeholder="Jelaskan peran agent dan bagaimana AI membantu pengguna..." 
                                      style="border-color: var(--color-border);">{{ request('deskripsi') }}</textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="t-small" style="color: var(--ink-soft);">
                                Status mode aktif: <strong>{{ $darkMode ? 'Dark Theme' : 'Light Theme' }}</strong>
                            </div>
                            <div class="d-flex gap-2">
                                @if(request()->filled('nama_ide'))
                                    <a href="{{ request()->fullUrlWithQuery(['nama_ide' => null, 'kategori' => null, 'deskripsi' => null]) }}" class="btn btn-outline-ink btn-sm">
                                        <i class="bi bi-x-circle"></i> Reset Form
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-yellow">
                                    <i class="bi bi-send-fill"></i> Kirim Ide Agent
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- CTA — cream bg, dark block --}}
    <div style="background: var(--cream); padding: 0 0 var(--s16);">

        <div class="wrap" style="padding-top: var(--s8);">
            <div class="cta-block">
                <div style="position: relative; z-index: 1; max-width: 480px;">
                    <div class="pill mb-4" style="background: rgba(168,200,64,.20); color: var(--lime); border-color: rgba(168,200,64,.25);">
                        <i class="bi bi-calculator-fill"></i> Fitur Lainnya
                    </div>
                    <h3 style="color: var(--white); font-size: clamp(1.3rem, 3vw, 2rem); margin-bottom: var(--s3);">Coba Kalkulator IPK Interaktif</h3>
                    <p style="color: rgba(255,255,255,0.45); font-size: 0.875rem;">Simulasi kalkulasi rata-rata IPK dari dua semester akademis.</p>
                </div>
                <a href="{{ route('hitung.ipk', ['ip1' => 3.85, 'ip2' => 3.90]) }}" class="btn btn-yellow btn-lg" style="position: relative; z-index: 1; flex-shrink: 0;">
                    Buka Kalkulator IPK <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

@else

    {{-- DEFAULT: General Assistant --}}
    <div style="background: var(--cream); padding: var(--s24) 0;">
        <div class="wrap" style="text-align: center;">
            <div class="icon-box lime" style="width: 80px; height: 80px; font-size: 32px; border-radius: var(--r-xl); margin: 0 auto var(--s6);">
                <i class="bi bi-robot"></i>
            </div>
            <div class="pill pill-neutral" style="margin: 0 auto var(--s5); width: fit-content;">Modul Utama AI</div>
            <h2 class="t-heading" style="margin-bottom: var(--s4);">General Assistant Agent</h2>
            <p style="max-width: 480px; margin: 0 auto; font-size: 1rem; line-height: 1.8; color: var(--ink-mid); margin-bottom: var(--s8);">
                General Assistant Agent berfungsi sebagai fondasi utama agen kecerdasan buatan interaktif. Agen ini siap dipersonalisasi sesuai kebutuhan spesifik pencarian karier, optimasi materi lamaran, atau panduan akademis.
            </p>
            <a href="{{ route('agent', ['tema' => 'Career Application Agent']) }}" class="btn btn-yellow btn-lg">
                <i class="bi bi-sparkles"></i> Aktifkan Mode Karier
            </a>
        </div>
    </div>

@endif

</div>

@endsection

