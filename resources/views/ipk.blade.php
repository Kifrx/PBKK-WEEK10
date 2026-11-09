@extends('layouts.public')
@section('title', 'Kalkulator IPK Akademis — ITS')
@section('content')

{{-- ═══ HERO — teal ═══ --}}
<div class="hero-block" style="background: var(--teal);">
    <div class="wrap">
        <div class="pill pill-white-strong mb-5">
            <i class="bi bi-calculator-fill"></i> Layanan Akademis ITS
        </div>
        <div class="row align-items-end g-0">
            <div class="col-12 col-lg-7">
                <h1 class="t-display mb-4" style="color: var(--white);">
                    Kalkulator<br>Rata-Rata IPK.
                </h1>
                <p style="color: rgba(255,255,255,0.65); font-size: 1rem; max-width: 440px; line-height: 1.75;">
                    Simulasi dan kalkulasi otomatis nilai IP 2 Semester serta rata-rata IPK Teknik Informatika ITS.
                </p>
            </div>
            <div class="col-12 col-lg-5 d-flex justify-content-lg-end mt-8 mt-lg-0" style="--mt: var(--s8);">
                {{-- Formula pill in hero --}}
                <div style="background: rgba(255,255,255,0.18); border-radius: var(--r-xl); padding: var(--s6) var(--s8); border: 1.5px solid rgba(255,255,255,0.25);">
                    <div class="t-label" style="color: rgba(255,255,255,0.55); margin-bottom: var(--s2);">Formula</div>
                    <div style="font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; color: var(--white); letter-spacing: -0.02em;">
                        (IP₁ + IP₂) ÷ 2
                    </div>
                    <div style="color: rgba(255,255,255,0.50); font-size: 0.8rem; margin-top: var(--s2);">Rata-rata dua semester</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ RESULT — cream bg ═══ --}}
<div style="background: var(--cream); padding: var(--s16) 0;">
    <div class="wrap">

        <div style="margin-bottom: var(--s8);">
            <div class="pill pill-teal mb-3"><i class="bi bi-check-circle-fill"></i> Hasil Perhitungan</div>
        </div>

        <div class="row g-5">

            {{-- Big number --}}
            <div class="col-12 col-lg-5">
                <div class="card card-p" style="text-align: center; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: var(--s5);">
                    <div class="t-label" style="color: var(--ink-soft);">Rata-Rata IPK Kumulatif</div>
                    <div class="t-stat" style="color: var(--ink);">{{ number_format($ipk, 2) }}</div>
                    <span class="chip {{ $badgeColor === 'success' ? 'lime' : 'teal' }}" style="font-size: 0.875rem; padding: 8px 18px;">
                        <i class="bi bi-award-fill"></i> {{ $predikat }}
                    </span>
                    <div style="width: 100%;">
                        <div class="progress-track">
                            <div class="progress-fill {{ $badgeColor === 'success' ? '' : 'teal' }}"
                                 style="width: {{ min(($ipk / 4.0) * 100, 100) }}%;"></div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: var(--s2);">
                            <span class="t-small">0.00</span>
                            <span class="t-small">4.00</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Breakdown --}}
            <div class="col-12 col-lg-7">
                <div class="card card-p" style="height: 100%;">
                    <h2 class="t-subhead mb-6">Rincian Perhitungan</h2>
                    <div style="display: flex; flex-direction: column; gap: var(--s3);">

                        @foreach([
                            ['IP Semester 1', number_format($val1, 2), 'lime'],
                            ['IP Semester 2', number_format($val2, 2), 'lime'],
                            ['Total Jumlah IP', number_format($total, 2), 'neutral'],
                        ] as [$label, $val, $chip])
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: var(--s4) var(--s5); background: var(--cream); border: 1px solid rgba(0,0,0,.08); border-radius: var(--r-md);">
                            <span style="font-size: 0.875rem; font-weight: 500; color: var(--ink-mid);">{{ $label }}</span>
                            <span style="font-family: 'Space Grotesk', sans-serif; font-size: 1.2rem; font-weight: 700; color: var(--ink);">{{ $val }}</span>
                        </div>
                        @endforeach

                        {{-- Formula --}}
                        <div style="padding: var(--s4) var(--s5); background: var(--ink); border-radius: var(--r-md);">
                            <div class="t-label" style="color: rgba(255,255,255,0.35); margin-bottom: var(--s2);">Rumus</div>
                            <code style="font-size: 0.875rem; color: var(--lime); font-family: 'SF Mono', 'Fira Code', monospace;">
                                ({{ number_format($val1, 2) }} + {{ number_format($val2, 2) }}) / 2 = {{ number_format($ipk, 2) }}
                            </code>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══ FORM — white bg ═══ --}}
<div style="background: var(--white); padding: var(--s16) 0 var(--s20);">
    <div class="wrap">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-7">
                <div class="pill pill-neutral mb-4"><i class="bi bi-sliders"></i> Hitung Ulang</div>
                <h2 class="t-heading mt-3 mb-2">Masukkan Nilai IP</h2>
                <p class="t-body mb-8">Masukkan dua nilai IP semester untuk menghitung rata-rata IPK.</p>

                <div class="card card-p">
                    <form id="ipkForm" onsubmit="calculateIpkUrl(event)" novalidate>
                        <div style="display: flex; flex-direction: column; gap: var(--s5);">
                            <div>
                                <label class="form-label" for="inputIp1">Nilai IP Semester 1</label>
                                <input type="number" step="0.01" min="0" max="4"
                                       id="inputIp1" class="form-input"
                                       placeholder="Contoh: 3.85"
                                       value="{{ $val1 }}" required>
                            </div>
                            <div>
                                <label class="form-label" for="inputIp2">Nilai IP Semester 2</label>
                                <input type="number" step="0.01" min="0" max="4"
                                       id="inputIp2" class="form-input"
                                       placeholder="Contoh: 3.90"
                                       value="{{ $val2 }}" required>
                            </div>
                            <button type="submit" class="btn btn-yellow btn-full btn-lg">
                                <i class="bi bi-calculator-fill"></i> Hitung IPK
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function calculateIpkUrl(e) {
        e.preventDefault();
        const ip1 = parseFloat(document.getElementById('inputIp1').value) || 0;
        const ip2 = parseFloat(document.getElementById('inputIp2').value) || 0;
        const baseRoute = "{{ route('hitung.ipk', ['ip1' => '__IP1__', 'ip2' => '__IP2__']) }}";
        window.location.href = baseRoute.replace('__IP1__', ip1).replace('__IP2__', ip2);
    }
</script>
@endpush
@endsection
