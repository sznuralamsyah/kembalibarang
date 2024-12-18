<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="font-sans antialiased dark:bg-white dark:text-white/50">
    <div class="bg-gray-50 text-black/50 dark:bg-white dark:text-white/50">
        @if (Route::has('login'))
            <nav class="w-full bg-white shadow-md fixed top-0 left-0 z-10 flex justify-end">
                @auth
                    <a href="{{ url('/home') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/60 dark:focus-visible:ring-white">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/60 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-black/60 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
        <div class="relative min-h-screen flex flex-col items-center selection:bg-[#FF2D20] selection:text-white">
            <img src="weblogo.jpeg" alt="img" class="w-80 h-60 my-20">
            <h1 class="text-black">Kembalikan barang yang hilang kepada pemiliknya, dengan cepat, tanpa ribet.</h1>
            <h1 class="text-black">Barangmu hilang? jangan panik, siapa tau ada orang jujur yang menemukannya. Cukup
                kunjungi Temukanlagi lalu masukkan detail barangmu. Kami bisa saja membantu barangmu kembali ke
                tanganmu.</h1>
            <h1 class="text-black text-center">Menemukan barang? jangan bingung, siapa tau pemiliknya sedang mencarinya
                dan kamu bisa . Cukup kunjungi Temukanlagi lalu masukkan detail barang yang kamu temukan. Kami bisa saja
                membantu barangnya kembali ke tangan pemiliknya.</h1>
        </div>
    </div>
</body>

</html>
