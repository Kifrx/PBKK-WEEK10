<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Dashboard Portal Akademik ITS") }}
            </h2>
            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ Auth::user()->role === "dosen" ? "bg-blue-100 text-blue-800" : (Auth::user()->role === "asdos" ? "bg-emerald-100 text-emerald-800" : "bg-purple-100 text-purple-800") }}">
                Peran Aktif: {{ strtoupper(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session("status"))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session("status") }}
                </div>
            @endif

            <div class="bg-gradient-to-r from-indigo-700 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="text-indigo-100 text-sm max-w-3xl">
                    Anda berhasil masuk ke Secure Academic Portal ITS.
                    Sistem menerapkan middleware cek.peran, ProposalPolicy, dan Global Gate.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-900 mb-1">1. Area Publik</h4>
                    <p class="text-sm text-gray-600 mb-4">Halaman publik bebas diakses.</p>
                    <a href="{{ route("beranda") }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                        Kunjungi Area Publik &rarr;
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-900 mb-1">2. Area Mahasiswa</h4>
                    <p class="text-sm text-gray-600 mb-4">Rencana proyek kelompok AI.</p>
                    <a href="{{ route("proposals.index") }}" class="text-sm font-semibold text-purple-600 hover:text-purple-800">
                        Buka Rencana Proyek AI &rarr;
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h4 class="text-lg font-bold text-gray-900 mb-1">3. Area Dosen &amp; Asdos</h4>
                    <p class="text-sm text-gray-600 mb-4">Review proposal dan input nilai.</p>
                    @can("kelola-portal")
                        <a href="{{ route("admin.proposals.index") }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-800">
                            Masuk Portal Admin &rarr;
                        </a>
                    @else
                        <span class="text-xs font-medium text-red-500 bg-red-50 px-2.5 py-1 rounded-full">
                            Terkunci (Khusus Dosen / Asdos)
                        </span>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
