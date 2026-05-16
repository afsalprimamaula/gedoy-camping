<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gedoy Camping Ground</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 text-gray-800 font-sans antialiased">

    <nav class="bg-emerald-800 text-white p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-widest flex items-center gap-2">
                🏕️ GEDOY
            </a>
            <ul class="hidden md:flex space-x-8 font-semibold">
                <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition">Beranda</a></li>
                <li><a href="#fasilitas" class="hover:text-amber-400 transition">Fasilitas</a></li>
                <li><a href="#paket" class="hover:text-amber-400 transition">Paket Camping</a></li>
            </ul>
            <a href="#booking" class="bg-amber-500 hover:bg-amber-600 text-white px-6 py-2 rounded-full font-bold shadow-md transition">
                Pesan Sekarang
            </a>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-emerald-900 text-gray-300 py-10 mt-20 border-t-4 border-amber-500">
        <div class="container mx-auto px-6 text-center">
            <p class="mb-4">📍 Ciater, Subang, Jawa Barat</p>
            <p>&copy; 2026 Gedoy Camping Ground. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
