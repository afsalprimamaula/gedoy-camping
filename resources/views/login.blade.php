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
                    "Sistem Manajemen Terpadu untuk Validasi Data Reservasi, Manajemen Paket Wisata, dan Analisis Pendapatan Pengelola."
                </p>
                <div class="mt-8 pt-8 border-t border-white/10 flex justify-center gap-6 text-xs text-emerald-200/70">
                    <span>⚡ Secure Authentication</span>
                    <span>•</span>
                    <span>📊 PostgreSQL Relational Data</span>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20 bg-white relative">
            
            <div class="absolute top-8 left-6 sm:left-12 lg:left-20">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-700 hover:text-emerald-900 transition-colors group">
                    <span class="transform group-hover:-translate-x-1 transition-transform">←</span> Kembali ke Beranda Wisata
                </a>
            </div>

            <div class="mx-auto w-full max-w-md">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang Admin 👋</h2>
                    <p class="text-sm text-gray-500 mt-2">Silakan masukkan akun kredensial Anda untuk mengakses Dashboard Pengelola.</p>
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
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white outline-none transition-all">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.01] active:scale-[0.99]">
                            Masuk ke Ruang Kerja Admin 🚀
                        </button>
                    </div>
                </form>

                <div class="mt-16 text-center">
                    <p class="text-xs text-gray-400 tracking-wide">
                        &copy; 2026 Gedoy Camping Park. Manajemen Informatika UNPAS.
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
