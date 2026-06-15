<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Gedoy Camping</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 h-full flex items-center justify-center">
    <div class="w-full h-full flex overflow-hidden bg-white">
        <div class="hidden lg:flex lg:w-1/2 bg-emerald-900 relative items-center justify-center p-12">
            <div class="absolute inset-0 opacity-20"><img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover"></div>
            <div class="relative z-10 text-center max-w-md">
                <h1 class="text-4xl font-black text-white mb-2">Mulai Petualanganmu ⛺</h1>
                <p class="text-emerald-100 text-sm">Dapatkan kemudahan pencatatan riwayat reservasi camping ground secara real-time.</p>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-20 relative bg-white">
            <div class="mx-auto w-full max-w-md">
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Registrasi Member</h2>
                <p class="text-sm text-gray-500 mt-2">Sudah punya akun? <a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:underline">Masuk di sini</a></p>

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl my-4 text-xs font-semibold">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('register.post') }}" method="POST" class="space-y-5 mt-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm text-gray-900">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required class="w-full pl-4 pr-12 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm text-gray-900">
                            <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none select-none">
                                👁️
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Ulangi Kata Sandi</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full pl-4 pr-12 py-2.5 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm text-gray-900">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 focus:outline-none select-none">
                                👁️
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 px-4 rounded-xl shadow transition duration-300 transform hover:scale-[1.01]">Buat Akun Member 🚀</button>
                </form>
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