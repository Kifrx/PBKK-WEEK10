<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.proposals.index') }}" class="text-gray-500 hover:text-gray-700">
                &larr; Kembali
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Peninjauan Proposal Proyek AI') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Informasi Detail Proposal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 sm:p-8">
                <div class="flex items-center justify-between border-b pb-4 mb-4">
                    <div>
                        <span class="px-2.5 py-0.5 text-xs font-semibold rounded-md bg-indigo-100 text-indigo-800">
                            {{ $proposal->kelompok }}
                        </span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2">{{ $proposal->judul }}</h3>
                        <p class="text-xs text-gray-500 mt-1">Diajukan oleh: <strong>{{ $proposal->user->name }}</strong> ({{ $proposal->user->email }}) • {{ $proposal->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="text-right">
                        <span class="text-xs font-medium text-gray-500 block">Status Nilai</span>
                        @if ($proposal->nilai !== null)
                            <span class="text-3xl font-black text-emerald-600">{{ $proposal->nilai }}</span>
                            <span class="text-gray-400 text-sm">/100</span>
                        @else
                            <span class="text-xs px-2.5 py-1 bg-amber-100 text-amber-800 rounded-full font-semibold">
                                Belum Dinilai
                            </span>
                        @endif
                    </div>
                </div>

                <div class="prose max-w-none text-gray-700 text-sm whitespace-pre-line leading-relaxed">
                    <h4 class="font-bold text-gray-900 mb-2">Deskripsi & Metodologi:</h4>
                    {{ $proposal->deskripsi }}
                </div>
            </div>

            <!-- Formulir Penilaian / Review Sesuai Peran -->
            <div id="form-nilai" class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 sm:p-8">
                @can('nilai-proposal')
                    <!-- Formulir Dosen: Input Nilai + Catatan Review -->
                    <h4 class="text-lg font-bold text-gray-900 mb-1 flex items-center gap-2">
                        <span>⭐</span>
                        <span>Form Penilaian Proposal (Khusus Dosen)</span>
                    </h4>
                    <p class="text-xs text-gray-500 mb-6">Sebagai dosen pengampu, Anda memiliki otorisasi Gate <code class="bg-gray-100 px-1 py-0.5 rounded font-mono">nilai-proposal</code> untuk memberikan nilai angka akhir.</p>

                    <form method="POST" action="{{ route('admin.proposals.grade', $proposal) }}" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <div class="max-w-xs">
                            <x-input-label for="nilai" :value="__('Nilai Akhir (Skala 0 - 100)')" />
                            <x-text-input id="nilai" name="nilai" type="number" min="0" max="100" class="mt-1 block w-full text-lg font-bold" :value="old('nilai', $proposal->nilai)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nilai')" />
                        </div>

                        <div>
                            <x-input-label for="catatan_review" :value="__('Catatan Review / Feedback Dosen')" />
                            <textarea id="catatan_review" name="catatan_review" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Berikan arahan pengembangan atau kritik konstruktif...">{{ old('catatan_review', $proposal->catatan_review) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('catatan_review')" />
                        </div>

                        <div class="pt-4 border-t flex justify-end">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                {{ __('Simpan Nilai & Review') }}
                            </x-primary-button>
                        </div>
                    </form>
                @else
                    <!-- Formulir Asisten Dosen: Hanya Catatan Feedback (Tanpa Nilai Angka) -->
                    <h4 class="text-lg font-bold text-gray-900 mb-1 flex items-center gap-2">
                        <span>💬</span>
                        <span>Form Feedback Review (Asisten Dosen)</span>
                    </h4>
                    <p class="text-xs text-gray-500 mb-6">
                        Sebagai Asisten Dosen, Anda berhak memeriksa kelengkapan proposal dan menulis catatan review/revisi untuk mahasiswa. Otorisasi pemberian nilai akhir dibatasi hanya untuk Dosen.
                    </p>

                    <form method="POST" action="{{ route('admin.proposals.review', $proposal) }}" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="catatan_review" :value="__('Catatan Feedback & Saran Revisi Asdos')" />
                            <textarea id="catatan_review" name="catatan_review" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Tulis catatan pengecekan dataset, code, atau proposal...">{{ old('catatan_review', $proposal->catatan_review) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('catatan_review')" />
                        </div>

                        <div class="pt-4 border-t flex justify-end">
                            <x-primary-button class="bg-emerald-600 hover:bg-emerald-700">
                                {{ __('Kirim Catatan Review') }}
                            </x-primary-button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>

