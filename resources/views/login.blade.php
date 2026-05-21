<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Gedoy Camping</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-emerald-50 h-screen font-sans antialiased overflow-hidden">

    <div class="flex h-full w-full">
        <div class="hidden lg:flex w-1/2 bg-emerald-900 relative items-center justify-center">
            <div class="absolute inset-0 opacity-40">
                <img src="https://images.unsplash.com/photo-1533873984035-25970ab07461?auto=format&fit=crop&w=1000&q=80" alt="Camping Forest" class="w-full h-full object-cover">
            </div>
            
            <div class="relative z-10 text-center px-12">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-2xl border border-white/20 shadow-2xl">
                    <h1 class="text-5xl font-extrabold text-white mb-4 tracking-wider">GEDOY<br><span class="text-amber-400">CAMPING</span></h1>
                    <p class="text-emerald-100 text-lg">Sistem Manajemen Pengelola Internal</p>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white shadow-2xl">
            <div class="w-full max-w-md">
                
                <div class="mb-10 text-center lg:text-left">
                    <a href="{{ route('home') }}" class="inline-block text-emerald-600 hover:text-emerald-800 text-sm font-semibold mb-6 flex items-center justify-center lg:justify-start gap-2 transition">
                        ← Kembali ke Halaman Publik
                    </a>
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang 👋</h2>
                    <p class="text-gray-500 mt-2">Silakan masuk ke panel admin.</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6 text-sm font-medium animate-pulse">
                        ⚠️ {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">✉️</span>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@gedoy.com"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition bg-gray-50 focus:bg-white text-gray-800">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi (Password)</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🔒</span>
                            <input type="password" name="password" required placeholder="Masukkan kata sandi..."
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition bg-gray-50 focus:bg-white text-gray-800">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg transition duration-300 transform hover:scale-[1.02]">
                        Masuk ke Dashboard 🚀
                    </button>
                </form>
                
                <p class="text-center text-xs text-gray-400 mt-12">
                    &copy; 2026 Gedoy Camping Ground. All rights reserved.
                </p>
            </div>
        </div>
    </div>

</body>
</html>