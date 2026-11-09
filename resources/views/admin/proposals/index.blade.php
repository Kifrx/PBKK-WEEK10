<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard Proyek Agen AI') }}
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Lihat proyek agen AI yang diajukan oleh kelompok mahasiswa.
                </p>
            </div>
            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                {{ Auth::user()->role === 'dosen' ? 'bg-blue-100 text-blue-800' : 'bg-emerald-100 text-emerald-800' }}">
                Role Anda: {{ strtoupper(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center space-x-2">
                    <span>✅</span>
                    <span class="text-sm font-medium">{{ session('status') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Semua Proposal Masuk Mahasiswa ({{ $proposals->count() }})</h3>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase font-semibold text-xs border-b">
                            <tr>
                                <th class="py-3 px-4">Kelompok & Mahasiswa</th>
                                <th class="py-3 px-4">Judul Rencana Proyek AI</th>
                                <th class="py-3 px-4 text-center">Nilai</th>
                                <th class="py-3 px-4">Catatan Review</th>
                                <th class="py-3 px-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($proposals as $prop)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="py-4 px-4">
                                        <div class="font-bold text-gray-900">{{ $prop->kelompok }}</div>
                                        <div class="text-xs text-gray-500">{{ $prop->user->name }}</div>
                                        <div class="text-xs text-gray-400 font-mono">{{ $prop->user->email }}</div>
                                    </td>
                                    <td class="py-4 px-4 max-w-md">
                                        <div class="font-semibold text-gray-800">{{ $prop->judul }}</div>
                                        <p class="text-xs text-gray-500 line-clamp-2 mt-0.5">{{ $prop->deskripsi }}</p>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        @if ($prop->nilai !== null)
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800">
                                                {{ $prop->nilai }} / 100
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-800">
                                                Belum Dinilai
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-xs italic text-gray-500 max-w-xs">
                                        {{ $prop->catatan_review ?? '-' }}
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Tombol Tinjau Detail -->
                                            <a href="{{ route('admin.proposals.show', $prop) }}" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded text-xs transition">
                                                👁️ Detail
                                            </a>

                                            @can('nilai-proposal')
                                                <a href="{{ route('admin.proposals.show', $prop) }}#form-nilai" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded text-xs transition shadow-sm">
                                                    ⭐ Input Nilai
                                                </a>
                                            @else
                                                <span class="px-2 py-1 text-[11px] font-medium text-gray-400 bg-gray-50 rounded border border-dashed border-gray-200" title="Hanya Dosen yang berhak memberi nilai angka">
                                                    (Nilai Khusus Dosen)
                                                </span>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-500">
                                        Belum ada proposal yang masuk dari mahasiswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

