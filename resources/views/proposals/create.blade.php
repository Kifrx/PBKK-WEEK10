<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Ajukan Rencana Proyek Kelompok AI') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 sm:p-8">
                <!-- Info Rate Limiter -->
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-900 text-xs flex items-center gap-2">
                    <span class="text-base">⚡</span>
                    <span><strong>Tantangan 1 (Rate Limiting Kustom):</strong> Form pengajuan ini dibatasi maksimal <strong>3 submit per menit</strong> untuk mencegah spam database.</span>
                </div>

                <form method="POST" action="{{ route('proposals.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="kelompok" :value="__('Nama Kelompok AI')" />
                        <x-text-input id="kelompok" name="kelompok" type="text" class="mt-1 block w-full" :value="old('kelompok')" required placeholder="Contoh: Kelompok AI-03 (RoboVision)" />
                        <x-input-error class="mt-2" :messages="$errors->get('kelompok')" />
                    </div>

                    <div>
                        <x-input-label for="judul" :value="__('Judul Rencana Proyek AI')" />
                        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul')" required placeholder="Contoh: Klasifikasi Citra Rontgen Paru-Paru Menggunakan Vision Transformer" />
                        <x-input-error class="mt-2" :messages="$errors->get('judul')" />
                    </div>

                    <div>
                        <x-input-label for="deskripsi" :value="__('Deskripsi Singkat & Metodologi')" />
                        <textarea id="deskripsi" name="deskripsi" rows="5" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required placeholder="Jelaskan latar belakang, arsitektur AI, dan dataset yang akan digunakan...">{{ old('deskripsi') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('proposals.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900 font-medium">
                            Batal
                        </a>
                        <x-primary-button>
                            {{ __('Submit Proposal') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

