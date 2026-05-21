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
        <div class="container mx-auto max-w-7xl px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-wider flex items-center gap-2 hover:text-emerald-200 transition">
                ⛺ Gedoy<span class="text-amber-400">Camping</span>
            </a>

            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-emerald-200 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold py-2 px-4 rounded-lg transition shadow-md transform hover:-translate-y-0.5">Daftar</a>
                @endguest

                @auth
                    <div class="relative inline-block text-left">
                        <div>
                            <button type="button" onclick="toggleProfileDropdown()" class="flex items-center gap-2 bg-emerald-900/60 hover:bg-emerald-900 border border-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow" id="menu-button">
                                <span class="text-base">👤</span>
                                <span>{{ Auth::user()->name }}</span>
                                <span class="text-[10px] text-emerald-300">▼</span>
                            </button>
                        </div>
                        <div id="profile-dropdown" class="hidden absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 outline-none">
                            <div class="px-4 py-3">
                                <p class="text-xs text-gray-400 font-medium">Masuk sebagai:</p>
                                <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                                <span class="inline-flex mt-1 items-center px-2 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider {{ Auth::user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                    {{ Auth::user()->role }}
                                </span>
                            </div>
                            <div class="py-1">
                                <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-50 font-medium">👤 Cek Profil Saya</a>
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.index') }}" class="text-emerald-700 block px-4 py-2 text-sm hover:bg-emerald-50 font-bold bg-emerald-50/50">📊 Dashboard Admin</a>
                                @endif
                            </div>
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 w-full text-left block px-4 py-2 text-sm hover:bg-red-50 font-bold">🚪 Keluar (Logout)</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        function toggleProfileDropdown() { document.getElementById('profile-dropdown').classList.toggle('hidden'); }
                        window.addEventListener('click', function(e) { const btn = document.getElementById('menu-button'); const dropdown = document.getElementById('profile-dropdown'); if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) { dropdown.classList.add('hidden'); } });
                    </script>
                @endauth
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div id="alert-success" class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded shadow-2xl flex items-center justify-between w-11/12 max-w-2xl transition-all duration-500">
            <div class="flex items-center gap-3">
                <span class="text-2xl">🎉</span>
                <p class="font-semibold">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('alert-success').style.display='none'" class="text-emerald-800 font-bold text-xl ml-4">&times;</button>
        </div>
        <script>setTimeout(() => { const el = document.getElementById('alert-success'); if(el) { el.style.opacity = '0'; setTimeout(() => el.remove(), 500); } }, 5000);</script>
    @endif

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-emerald-900 text-gray-300 py-10 mt-20 border-t-4 border-amber-500">
        <div class="container mx-auto px-6 text-center">
            <p class="mb-4">📍 Ciater, Subang, Jawa Barat</p>
            <p>&copy; 2026 Gedoy Camping Ground. Manajemen Informatika UNPAS.</p>
        </div>
    </footer>

</body>
</html>