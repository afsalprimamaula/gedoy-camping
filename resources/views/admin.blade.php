<!DOCTYPE html>
<html lang="id" class="h-full m-0 p-0">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pengelola - Gedoy Camping Park</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full m-0 p-0 text-slate-800 font-sans antialiased overflow-hidden bg-slate-50">

    <div class="flex h-screen w-full overflow-hidden">
        
        <aside class="w-64 bg-emerald-950 text-white flex flex-col justify-between shadow-2xl z-20 shrink-0 hidden md:flex h-full">
            <div>
                <div class="p-6 border-b border-white/10 bg-emerald-900/20">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">⛺</span>
                        <div>
                            <h2 class="text-lg font-black tracking-wider leading-none">Gedoy<span class="text-amber-400">Admin</span></h2>
                            <p class="text-[10px] text-emerald-400 font-medium mt-1 uppercase tracking-widest">Extranet System</p>
                        </div>
                    </div>
                </div>

                <nav class="p-4 space-y-1">
                    <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-amber-500 text-white shadow-md transition-all">
                        <span class="text-base">📊</span> Dashboard Utama
                    </a>
                    <a href="#paket" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-emerald-200/90 hover:bg-white/5 hover:text-white transition-all group">
                        <span class="text-base text-emerald-400 group-hover:text-white">⛺</span> Manajemen Paket
                    </a>
                    <a href="#laporan" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-emerald-200/90 hover:bg-white/5 hover:text-white transition-all group">
                        <span class="text-base text-emerald-400 group-hover:text-white">💰</span> Laporan Keuangan
                    </a>
                    <a href="#pengaturan" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-emerald-200/90 hover:bg-white/5 hover:text-white transition-all group">
                        <span class="text-base text-emerald-400 group-hover:text-white">⚙️</span> Pengaturan Sistem
                    </a>
                </nav>
            </div>

            <div class="p-4 border-t border-white/10 bg-emerald-900/10 flex items-center justify-between">
                <div class="flex items-center gap-3 truncate">
                    <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center font-black text-white text-sm shadow shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-emerald-400 font-semibold tracking-wider uppercase">Master Admin</p>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
            
            <header class="bg-white h-16 border-b border-slate-200 flex items-center justify-between px-6 md:px-8 z-10 shadow-sm shrink-0">
                <div class="flex items-center gap-4">
                    <span class="text-sm font-semibold text-slate-400 hidden sm:inline">Internal System</span>
                    <span class="text-slate-300 hidden sm:inline">/</span>
                    <span class="text-sm font-bold text-emerald-800 bg-emerald-50 px-3 py-1 rounded-lg border border-emerald-100">Live Production Mode</span>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-xs font-bold text-slate-600 hover:text-emerald-700 bg-slate-100 hover:bg-slate-200/80 px-4 py-2 rounded-xl transition flex items-center gap-1.5">
                        🌐 Lihat Website Publik
                    </a>
                    <div class="h-6 w-px bg-slate-200"></div>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 px-4 py-2 rounded-xl transition">
                            🚪 Keluar (Logout)
                        </button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-8">
                
                @if (session('success'))
                    <div id="alert-dashboard" class="bg-emerald-50 border-l-4 border-emerald-600 p-4 rounded-xl shadow-sm flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-xl">✨</span>
                            <p class="text-sm font-bold text-emerald-900">{{ session('success') }}</p>
                        </div>
                        <button onclick="document.getElementById('alert-dashboard').remove()" class="text-emerald-800 font-bold text-lg">&times;</button>
                    </div>
                @endif

                <div>
                    <h1 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Selamat Datang di Extranet Wisata</h1>
                    <p class="text-sm text-slate-500 mt-1">Kelola pergerakan data pemesanan area camping ground secara real-time di bawah kendali database PostgreSQL.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 flex items-center justify-between shadow-sm">
                        <div class="space-y-1">
                            <p class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Total Reservasi</p>
                            <p class="text-3xl font-black text-slate-900">{{ $bookings->count() }} <span class="text-xs font-medium text-slate-400">Pemesanan</span></p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-xl shadow-sm">📅</div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 flex items-center justify-between shadow-sm">
                        <div class="space-y-1">
                            <p class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Menunggu Validasi</p>
                            <p class="text-3xl font-black text-amber-600">{{ $pendingCount }} <span class="text-xs font-medium text-slate-400">Antrean</span></p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-xl shadow-sm {{ $pendingCount > 0 ? 'animate-pulse' : '' }}">⏳</div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 flex items-center justify-between shadow-sm">
                        <div class="space-y-1">
                            <p class="text-[11px] text-slate-400 font-extrabold uppercase tracking-wider">Pendapatan Bersih</p>
                            <p class="text-3xl font-black text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-xl shadow-sm">💰</div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-extrabold text-slate-900 text-base">Manajemen Kuota & Validasi Tagihan</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-slate-100/60 text-slate-500 text-[11px] font-extrabold uppercase tracking-wider border-b border-slate-200/60">
                                    <th class="py-4 px-6">Info Kontak Pelanggan</th>
                                    <th class="py-4 px-6">Pilihan Paket</th>
                                    <th class="py-4 px-6">Durasi Nginap</th>
                                    <th class="py-4 px-6">Total Bayar</th>
                                    <th class="py-4 px-6 text-center">Status</th>
                                    <th class="py-4 px-6 text-center">Aksi Pengelola</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-700 text-xs divide-y divide-slate-100">
                                @forelse($bookings as $booking)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    
                                    <td class="py-4 px-6">
                                        <span class="text-[9px] font-black tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 uppercase">
                                            {{ $booking->booking_code }}
                                        </span>
                                        <h4 class="font-bold text-slate-900 mt-2 text-sm">{{ $booking->customer_name }}</h4>
                                        <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-2">
                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_phone) }}" target="_blank" class="hover:text-emerald-700 transition-colors font-medium">
                                                📞 {{ $booking->customer_phone }}
                                            </a>
                                            <span>•</span>
                                            <span>{{ $booking->customer_email }}</span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6">
                                        <p class="font-bold text-slate-800 text-sm">{{ $booking->campingPackage->name }}</p>
                                        <p class="text-slate-400 mt-0.5">{{ $booking->total_guests }} Orang Tamu</p>
                                    </td>

                                    <td class="py-4 px-6 font-medium text-slate-600">
                                        <div class="flex items-center gap-2">
                                            <span class="w-8 text-[9px] font-bold text-slate-400 uppercase">Masuk</span>
                                            <span class="text-slate-800 font-bold">{{ \Carbon\Carbon::parse($booking->check_in_date)->translatedFormat('d M Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="w-8 text-[9px] font-bold text-slate-400 uppercase">Keluar</span>
                                            <span class="text-rose-600 font-bold">{{ \Carbon\Carbon::parse($booking->check_out_date)->translatedFormat('d M Y') }}</span>
                                        </div>
                                    </td>

                                    <td class="py-4 px-6 font-extrabold text-slate-900 text-sm">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </td>

                                    <td class="py-4 px-6 text-center">
                                        @if($booking->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-200">
                                                Menunggu
                                            </span>
                                        @elseif($booking->status == 'confirmed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Disetujui
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-rose-50 text-rose-700 border border-rose-200">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" onclick="return confirm('Konfirmasi pembayaran dan terima pesanan ini?')" class="bg-white hover:bg-emerald-600 text-slate-700 hover:text-white p-2 rounded-xl border border-slate-200 shadow-sm transition-all hover:scale-105" title="Terima Reservasi">
                                                        ✅
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" onclick="return confirm('Batalkan pesanan ini?')" class="bg-white hover:bg-rose-600 text-slate-700 hover:text-white p-2 rounded-xl border border-slate-200 shadow-sm transition-all hover:scale-105" title="Tolak Reservasi">
                                                        ❌
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.destroy', $booking->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus data pesanan dari sistem database secara permanen?')" class="text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-600 text-[10px] font-bold py-1.5 px-3 rounded-lg border border-rose-200 transition-all">
                                                        🗑️ Hapus Data
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="py-16 text-center">
                                        <p class="text-slate-400 text-sm font-bold">Belum ada transaksi registrasi paket masuk.</p>
                                        <p class="text-[11px] text-slate-300 mt-0.5">Semua pengisian formulir reservasi otomatis terdata di sini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

</body>
</html>