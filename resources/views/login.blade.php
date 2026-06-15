<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelola - Gedoy Camping Ground</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 h-full font-sans antialiased flex items-center justify-center">

    <div class="w-full h-full flex overflow-hidden bg-white">
        <div class="hidden lg:flex lg:w-1/2 bg-emerald-900 relative items-center justify-center p-12">
            <div class="absolute inset-0 opacity-30 select-none pointer-events-none">
                <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1200&q=80" alt="Gedoy Nature" class="w-full h-full object-cover">
            </div>
            
            <div class="relative z-10 max-w-lg text-center">
                <div class="inline-flex p-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl mb-6 text-3xl">
                    🏕️
                </div>
                <h1 class="text-4xl font-black text-white tracking-tight leading-none mb-4">
                    Gedoy <span class="text-amber-400">Camping Park</span>
                </h1>
                <p class="text-emerald-100/90 text-lg font-medium leading-relaxed">
                    "Sistem Manajemen Terpadu untuk Validasi Data Reservasi dan Manajemen Paket Wisata."
                </p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20 bg-white relative">

            <div class="mx-auto w-full max-w-md">
                <div class="mb-8 pt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-800 transition mb-6">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mt-6">Selamat datang kembali</h2>
                    <p class="text-sm text-gray-500 mt-2">Masuk ke akun Anda untuk melanjutkan</p>
                </div>

                @if ($errors->any())
                    <div class="flex items-start gap-3 bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-xl mb-6 shadow-sm">
                        <span class="text-lg">⚠️</span>
                        <div class="text-sm font-semibold">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email Resmi</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 select-none">
                                ✉️
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                placeholder="nama@gedoy.com"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi (Password)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 select-none">
                                🔒
                            </span>
                            <input id="password" type="password" name="password" required 
                                placeholder="••••••••"
                                class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white outline-none transition-all">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none select-none">
                                👁️
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm py-2">
                        <label class="flex items-center gap-2 text-gray-600 cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="font-semibold text-emerald-700 hover:text-emerald-900 transition-colors">Lupa password?</a>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99]">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm text-gray-500">
                    Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:text-emerald-900 transition-colors">Daftar sekarang</a>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-xs text-gray-400 tracking-wide">
                        &copy; 2026 Gedoy Camping Park.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(id, btn) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
            }
        }
    </script>
</body>
</html>
