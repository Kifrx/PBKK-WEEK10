@extends('academic.layout')

@section('title', $definition['label'])

@section('content_header')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <h1>Data {{ $definition['label'] }}</h1>
        @can('tambah-data')
            <a class="btn btn-primary" href="{{ route("admin.{$module}.create") }}">
                <i class="bi bi-plus-lg" aria-hidden="true"></i> Tambah {{ $definition['label'] }}
            </a>
        @endcan
    </div>
@stop

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach

    <div class="card academic-list">
        <div class="card-body">
            <form method="GET" action="{{ route("admin.{$module}.index") }}" class="row g-3 align-items-end">
                <div class="col-sm">
                    <label class="form-label" for="q">Kata kunci</label>
                    <input class="form-control" type="search" name="q" id="q" maxlength="100"
                           value="{{ $filters['q'] ?? '' }}" placeholder="{{ implode(' atau ', array_map(fn ($key) => $definition['fields'][$key], $definition['search'])) }}">
                </div>
                @if ($hasDepartment)
                    <div class="col-sm">
                        <label class="form-label" for="departemen_id">Departemen</label>
                        <select class="form-select" id="departemen_id" name="departemen_id">
                            <option value="">Semua departemen</option>
                            @foreach ($departments as $id => $name)
                                <option value="{{ $id }}" @selected(($filters['departemen_id'] ?? null) == $id)>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($module === 'mahasiswa')
                    <div class="col-sm">
                        <label class="form-label" for="is_active">Status</label>
                        <select class="form-select" id="is_active" name="is_active">
                            <option value="">Semua status</option>
                            <option value="1" @selected((string) ($filters['is_active'] ?? '') === '1')>Aktif</option>
                            <option value="0" @selected((string) ($filters['is_active'] ?? '') === '0')>Cuti</option>
                        </select>
                    </div>
                @endif
                <div class="col-sm-auto">
                    <button class="btn btn-primary" type="submit">Cari</button>
                    <a class="btn btn-outline-secondary" href="{{ route("admin.{$module}.index") }}">Reset</a>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 small">
                <thead>
                    <tr>
                        @foreach ($definition['fields'] as $label)
                            <th scope="col">{{ $label }}</th>
                        @endforeach
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            @foreach ($definition['fields'] as $key => $label)
                                <td>
                                    @switch($key)
                                        @case('departemen_id') {{ $record->departemen->nama }} @break
                                        @case('dosen_id') {{ $record->dosen->nama }} @break
                                        @case('deadline') {{ $record->deadline->format('d/m/Y') }} @break
                                        @case('is_active')
                                            <span class="badge rounded-pill {{ $record->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">
                                                {{ $record->is_active ? 'Aktif' : ($module === 'mahasiswa' ? 'Cuti' : 'Nonaktif') }}
                                            </span>
                                            @break
                                        @default {{ $record->$key ?? '—' }}
                                    @endswitch
                                </td>
                            @endforeach
                            <td>
                                <div class="d-flex gap-2">
                                    @can('edit-data')
                                        <a class="btn btn-sm btn-outline-primary" href="{{ route("admin.{$module}.edit", $record) }}">Edit</a>
                                    @endcan
                                    @can('hapus-data')
                                        <form method="POST" action="{{ route("admin.{$module}.destroy", $record) }}"
                                              onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ count($definition['fields']) + 1 }}" class="p-4 text-center">Tidak ada data yang ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if ($records->hasPages())
        {{ $records->links('pagination::bootstrap-5') }}
    @endif
@stop
