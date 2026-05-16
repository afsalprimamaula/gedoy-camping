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
        </nav>

    @if (session('error'))
        <div id="alert-error" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded shadow-2xl flex items-center justify-between w-11/12 max-w-2xl transition-all duration-500">
            <div class="flex items-center gap-3">
                <span class="text-2xl">⚠️</span>
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
            <button onclick="document.getElementById('alert-error').style.display='none'" class="text-red-800 hover:text-red-900 font-bold text-xl ml-4">&times;</button>
        </div>
        <script>setTimeout(() => { const el = document.getElementById('alert-error'); if(el) el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }, 6000);</script>
    @endif

    @if ($errors->any())
        <div id="alert-validation" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded shadow-2xl w-11/12 max-w-2xl transition-all duration-500">
            <div class="flex justify-between items-start">
                <div class="flex gap-3">
                    <span class="text-2xl">❌</span>
                    <div>
                        <p class="font-bold mb-1">Mohon periksa kembali form Anda:</p>
                        <ul class="list-disc ml-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button onclick="document.getElementById('alert-validation').style.display='none'" class="text-red-800 hover:text-red-900 font-bold text-xl ml-4">&times;</button>
            </div>
        </div>
        <script>setTimeout(() => { const el = document.getElementById('alert-validation'); if(el) el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }, 8000);</script>
    @endif
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
