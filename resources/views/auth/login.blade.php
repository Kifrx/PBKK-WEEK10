<x-guest-layout>
    <x-slot name="title">Masuk Portal</x-slot>
    <x-slot name="subtitle">Gunakan akunmu untuk membuka portal akademik.</x-slot>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-1 block text-sm font-semibold">Email</label>
            <input id="email" class="block w-full rounded-xl border-gray-300 bg-gray-50 px-3 py-3 focus:border-emerald-600 focus:bg-white focus:ring-emerald-600" type="email" name="email" value="{{ old('email') }}"
                   placeholder="nama@contoh.com" required autocomplete="username" autocapitalize="none" spellcheck="false"
                   @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
            <x-input-error id="email-error" :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div x-data="{ visible: false }">
            <label for="password" class="mb-1 block text-sm font-semibold">Kata sandi</label>
            <div class="relative">
                <input id="password" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 pl-3 pr-28 focus:border-emerald-600 focus:bg-white focus:ring-emerald-600"
                       type="password" x-bind:type="visible ? 'text' : 'password'" name="password"
                       required autocomplete="current-password"
                       @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                <button type="button" hidden x-bind:hidden="false" x-on:click="visible = !visible"
                        class="absolute inset-y-0 right-2 rounded-lg px-2 text-xs font-semibold text-emerald-800 hover:underline"
                        aria-controls="password" x-text="visible ? 'Sembunyikan' : 'Tampilkan'">Tampilkan</button>
            </div>
            <x-input-error id="password-error" :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-2 text-sm">
            <label for="remember_me" class="inline-flex cursor-pointer items-center gap-2">
                <input id="remember_me" type="checkbox" name="remember" @checked(old('remember')) class="rounded border-gray-300 text-emerald-700 focus:ring-emerald-600">
                Ingat saya
            </label>

            @if (Route::has('password.request'))
                <a class="text-emerald-800 underline" href="{{ route('password.request') }}">Lupa kata sandi?</a>
            @endif
        </div>

        <button type="submit" class="w-full rounded-xl bg-emerald-800 px-4 py-3 font-semibold text-white transition-colors hover:bg-emerald-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-800">Masuk <span aria-hidden="true">→</span></button>
    </form>

    @if (app()->environment('local'))
        <div class="mt-5 rounded-xl border border-emerald-100 bg-emerald-50 p-3">
            <p class="mb-2 text-xs font-semibold text-emerald-900">Akun demo lokal</p>
            <div class="flex flex-wrap gap-2">
                @foreach (['Admin' => 'admin', 'Staf' => 'staf'] as $label => $account)
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="email" value="{{ $account }}@its.ac.id">
                        <input type="hidden" name="password" value="password">
                        <button type="submit" class="rounded-lg border border-emerald-200 bg-white px-3 py-2 text-xs font-semibold text-emerald-900 hover:bg-emerald-100">
                            Auto-Login {{ $label }}
                        </button>
                    </form>
                @endforeach
            </div>
        </div>
    @endif

    <p class="mt-6 border-t border-gray-200 pt-5 text-center text-sm text-gray-600">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold text-emerald-800 underline">Buat akun</a>
    </p>
</x-guest-layout>
