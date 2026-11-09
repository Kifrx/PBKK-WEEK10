<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Akun' }} — ITS Academic</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <main class="flex min-h-screen items-center justify-center bg-gradient-to-br from-lime-100 via-emerald-50 to-stone-100 px-4 py-8">
            <section class="w-full max-w-md overflow-hidden rounded-3xl border border-emerald-100 bg-white shadow-xl">
                <div class="h-1.5 bg-lime-400" aria-hidden="true"></div>
                <div class="p-6 sm:p-9">
                    <header class="mb-6 text-center">
                        <span class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-lime-100">
                            <img src="{{ asset('logo-its.png') }}" width="36" height="36" alt="Lambang ITS">
                        </span>
                        <p class="text-xs font-semibold uppercase tracking-widest text-emerald-800">Portal Akademik ITS</p>
                        @isset($title)
                            <h1 class="mt-2 text-3xl font-bold tracking-tight">{{ $title }}</h1>
                        @endisset
                        @isset($subtitle)
                            <p class="mt-2 text-sm leading-relaxed text-gray-600">{{ $subtitle }}</p>
                        @endisset
                    </header>
                    {{ $slot }}
                </div>
            </section>
        </main>
    </body>
</html>
