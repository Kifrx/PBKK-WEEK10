<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Rencana Proyek Kelompok AI') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">Area Mahasiswa: Pengajuan dan penyuntingan proposal rencana proyek kelompok AI.</p>
            </div>
            @can('create', App\Models\Proposal::class)
                <a href="{{ route('proposals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg shadow-sm transition">
                    + Ajukan Proposal Baru
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span>✅</span>
                        <span class="text-sm font-medium">{{ session('status') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Daftar Proposal Anda ({{ $proposals->count() }})</h3>

                    @if ($proposals->isEmpty())
                        <div class="text-center py-12">
                            <div class="text-5xl mb-3">📝</div>
                            <h4 class="text-lg font-semibold text-gray-700">Belum ada proposal proyek diajukan</h4>
                            <p class="text-gray-500 text-sm mt-1 max-w-md mx-auto">
                                Sebagai mahasiswa, Anda dapat mengajukan ide rencana proyek kelompok kecerdasan buatan sekarang.
                            </p>
                            @can('create', App\Models\Proposal::class)
                                <a href="{{ route('proposals.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium text-sm rounded-lg hover:bg-indigo-700 transition">
                                    Ajukan Proposal Pertama
                                </a>
                            @else
                                <p class="text-xs text-amber-600 mt-3 font-medium">
                                    (Anda login sebagai {{ Auth::user()->role }}. Hanya akun mahasiswa yang dapat membuat proposal baru).
                                </p>
                            @endcan
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($proposals as $prop)
                                <div class="p-5 border border-gray-200 rounded-xl hover:border-indigo-300 transition bg-gray-50/50">
                                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md bg-indigo-100 text-indigo-800">
                                                    {{ $prop->kelompok }}
                                                </span>
                                                <span class="text-xs text-gray-400">
                                                    Diajukan: {{ $prop->created_at->format('d M Y, H:i') }}
                                                </span>
                                            </div>
                                            <h4 class="text-lg font-bold text-gray-900">{{ $prop->judul }}</h4>
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ $prop->deskripsi }}</p>
                                        </div>

                                        <div class="flex items-center gap-4 shrink-0">
                                            <!-- Status Nilai -->
                                            <div class="text-right">
                                                @if ($prop->nilai !== null)
                                                    <div class="text-xs text-gray-500 font-medium">Nilai Akhir:</div>
                                                    <div class="text-2xl font-black text-emerald-600">{{ $prop->nilai }}/100</div>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">
                                                        ⏳ Menunggu Nilai Dosen
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Aksi Otorisasi Policy -->
                                            <div class="flex items-center gap-2">
                                                @can('update', $prop)
                                                    <a href="{{ route('proposals.edit', $prop) }}" class="px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-md transition">
                                                        ✏️ Sunting
                                                    </a>
                                                @endcan

                                                @can('delete', $prop)
                                                    <form method="POST" action="{{ route('proposals.destroy', $prop) }}" onsubmit="return confirm('Yakin ingin menghapus proposal ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold rounded-md transition">
                                                            🗑️ Hapus
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>

                                    @if ($prop->catatan_review)
                                        <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600 flex items-start gap-2">
                                            <span class="font-bold text-gray-700">💬 Feedback Dosen/Asdos:</span>
                                            <span class="italic">{{ $prop->catatan_review }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

