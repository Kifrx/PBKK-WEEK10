@extends('layouts.public')
@section('title', 'Profil Jurusan — DTIF FTEIC ITS')
@section('content')

{{-- ═══ HERO — orange/amber ═══ --}}
<div class="hero-block" style="background: var(--orange);">
    <div class="wrap">
        <div class="pill pill-white-strong mb-5">
            <i class="bi bi-building"></i> Departemen Teknik Informatika
        </div>
        <h1 class="t-display mb-4" style="color: var(--white);">Teknik Informatika<br>ITS Surabaya.</h1>
        <p style="color: rgba(255,255,255,0.65); font-size: 1rem;">Fakultas Teknologi Elektro dan Informatika Cerdas (FTEIC)</p>
    </div>
</div>

{{-- ═══ VISI MISI — cream ═══ --}}
<div style="background: var(--cream); padding: var(--s16) 0;">
    <div class="wrap">
        <div class="pill pill-orange mb-3"><i class="bi bi-compass"></i> Visi & Misi</div>
        <h2 class="t-heading mt-3 mb-8">Arah & Tujuan Departemen</h2>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--s5);">
            <div class="card card-p" style="border-top: 4px solid var(--lime);">
                <div class="pill pill-green mb-4">VISI</div>
                <p class="t-body" style="margin-bottom: var(--s3);">Sejalan dengan visi ITS, Departemen Informatika bertujuan menjadi inovator bidang informatika yang unggul nasional dengan reputasi internasional.</p>
                <p class="t-body">DTIF berfokus menjadi lembaga pendidikan unggul dan inovatif-inventif dalam informatika cerdas, mendukung transformasi digital dan berkontribusi kepada masyarakat.</p>
            </div>
            <div class="card card-p" style="border-top: 4px solid var(--purple);">
                <div class="pill pill-purple mb-4">MISI</div>
                <ol style="padding-left: var(--s5); margin: 0; display: flex; flex-direction: column; gap: var(--s3);">
                    @foreach([
                        'Menyelenggarakan pembelajaran berkualitas standar nasional dan internasional.',
                        'Melaksanakan penelitian inovatif, bermutu, dan bermanfaat.',
                        'Meningkatkan pemanfaatan teknologi informasi untuk masyarakat.',
                        'Menjalin kemitraan dengan berbagai lembaga dalam dan luar negeri.',
                    ] as $m)
                    <li class="t-body">{{ $m }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- ═══ PROGRAM STUDI — white ═══ --}}
<div style="background: var(--white); padding: var(--s16) 0;">
    <div class="wrap">
        <div class="pill pill-purple mb-3"><i class="bi bi-journal-bookmark"></i> Program Studi</div>
        <h2 class="t-heading mt-3 mb-2">6 Jenjang Program Studi</h2>
        <p class="t-body mb-8">Jenjang pendidikan yang diselenggarakan DTIF FTEIC ITS.</p>

        <div class="row g-3">
            @foreach([
                ['bi-mortarboard-fill', 'lime',   'Teknik Informatika S1',               'Sarjana Reguler'],
                ['bi-globe2',           'purple',  'Teknik Informatika (IUP)',             'International Undergraduate'],
                ['bi-cpu-fill',         'teal',    'Rekayasa Kecerdasan Artifisial (S1)',  'Sarjana AI'],
                ['bi-code-square',      'orange',  'Rekayasa Perangkat Lunak (S1)',        'Sarjana Software Engineering'],
                ['bi-book-half',        'lime',    'Teknik Informatika (S2)',              'Magister'],
                ['bi-award-fill',       'yellow',  'Ilmu Komputer (S3)',                   'Doktor'],
            ] as [$icon, $color, $prodi, $jenjang])
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card card-p-sm card-hover" style="display: flex; align-items: center; gap: var(--s4);">
                    <div class="icon-box {{ $color }}"><i class="bi {{ $icon }}"></i></div>
                    <div>
                        <div style="font-size: 0.9rem; font-weight: 700; color: var(--ink);">{{ $prodi }}</div>
                        <div style="font-size: 0.75rem; color: var(--ink-soft); margin-top: 2px;">{{ $jenjang }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══ LABORATORIUM — cream ═══ --}}
<div style="background: var(--cream); padding: var(--s16) 0 var(--s20);">
    <div class="wrap">
        <div class="pill pill-neutral mb-3"><i class="bi bi-motherboard"></i> Laboratorium</div>
        <h2 class="t-heading mt-3 mb-2">6 Laboratorium Bidang Minat</h2>
        <p class="t-body mb-8">Laboratorium pendukung riset dan pembelajaran di DTIF ITS.</p>

        <div class="row g-4">
            @foreach([
                ['bi-diagram-3-fill',     'lime',   'Lab Rekayasa Perangkat Lunak',        'Metodologi, arsitektur, dan pengujian sistem perangkat lunak.'],
                ['bi-robot',              'purple', 'Lab Komputasi Cerdas & Visi',          'Kecerdasan buatan, machine learning, dan pengolahan citra digital.'],
                ['bi-controller',         'teal',   'Lab Grafika, Interaksi, Gim & Analitik','Grafika komputer, UI/UX, game development, dan data analytics.'],
                ['bi-terminal-box',       'orange', 'Lab Algoritma & Pemrograman',          'Struktur data, kompleksitas algoritma, dan pemrograman kompetitif.'],
                ['bi-database-fill-gear', 'coral',  'Lab Manajemen Cerdas Informasi',       'Basis data skala besar, pengenalan pola data, dan sistem informasi.'],
                ['bi-calculator-fill',    'yellow', 'Lab Pemodelan & Komputasi Terapan',    'Simulasi sistem kompleks, komputasi terdistribusi, dan pemodelan matematis.'],
            ] as [$icon, $color, $lab, $desc])
            <div class="col-12 col-sm-6">
                <div class="card card-p card-hover" style="display: flex; align-items: flex-start; gap: var(--s4);">
                    <div class="icon-box {{ $color }}" style="flex-shrink: 0;"><i class="bi {{ $icon }}"></i></div>
                    <div>
                        <div style="font-size: 0.9rem; font-weight: 700; color: var(--ink); margin-bottom: 4px;">{{ $lab }}</div>
                        <div style="font-size: 0.8rem; color: var(--ink-soft); line-height: 1.6;">{{ $desc }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
