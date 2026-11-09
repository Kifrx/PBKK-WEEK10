@extends('academic.layout')

@php($heading = ($record ? 'Edit ' : 'Tambah ').$definition['label'])

@section('title', $heading)

@section('content_header')
    <h1>{{ $heading }}</h1>
@stop

@section('content')
    <div class="card" style="max-width: 48rem">
        <form method="POST" action="{{ $record ? route("admin.{$module}.update", $record) : route("admin.{$module}.store") }}">
            @csrf
            @if ($record)
                @method('PUT')
            @endif
            <div class="card-body">
                @foreach ($definition['fields'] as $key => $label)
                    @php($value = old($key, $key === 'deadline' ? $record?->deadline?->format('Y-m-d') : ($record?->$key ?? ($key === 'is_active' ? 1 : null))))
                    <div class="mb-3">
                        <label class="form-label" for="{{ $key }}">{{ $label }}</label>
                        @if (isset($options[$key]))
                            <select class="form-select @error($key) is-invalid @enderror" name="{{ $key }}" id="{{ $key }}" required>
                                <option value="">Pilih {{ $label }}</option>
                                @foreach ($options[$key] as $id => $name)
                                    <option value="{{ $id }}" @selected($value !== null && (string) (int) $value === (string) $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        @elseif ($key === 'deskripsi')
                            <textarea class="form-control @error($key) is-invalid @enderror" name="{{ $key }}" id="{{ $key }}" rows="4" maxlength="10000">{{ $value }}</textarea>
                        @else
                            <input class="form-control @error($key) is-invalid @enderror" name="{{ $key }}" id="{{ $key }}"
                                   type="{{ match ($key) { 'email' => 'email', 'deadline' => 'date', default => 'text' } }}"
                                   value="{{ $value }}" required>
                        @endif
                        @error($key)
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a class="btn btn-outline-secondary" href="{{ route("admin.{$module}.index") }}">Kembali</a>
            </div>
        </form>
    </div>
@stop
