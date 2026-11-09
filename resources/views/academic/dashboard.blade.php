@extends('academic.layout')

@section('title', 'Dashboard Akademik')

@section('content_header')
    <h1>Dashboard Akademik</h1>
@stop

@section('content')
    <div class="row g-3">
        @foreach ($statistics as $statistic)
            <div class="col-12 col-md-4">
                <div class="small-box text-bg-{{ $statistic['theme'] }}">
                    <div class="inner">
                        <h2 class="h1 fw-bold">{{ number_format($statistic['count'], 0, ',', '.') }}</h2>
                        <p>{{ $statistic['label'] }}</p>
                    </div>
                    <i class="small-box-icon {{ $statistic['icon'] }}" aria-hidden="true"></i>
                    <a href="{{ route($statistic['route']) }}" class="small-box-footer link-light">
                        Lihat data <i class="bi bi-arrow-right-circle" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@stop
