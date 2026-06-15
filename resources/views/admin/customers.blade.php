<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Data Pelanggan – Gedoy Camping Park</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .nav-active {
            background: linear-gradient(135deg, rgba(245,158,11,0.15) 0%, rgba(245,158,11,0.05) 100%);
            border: 1px solid rgba(245,158,11,0.3); color: #f59e0b;
        }
        aside::-webkit-scrollbar { width: 3px; }
        aside::-webkit-scrollbar-track { background: transparent; }
        aside::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }
        aside { background: linear-gradient(180deg, #071410 0%, #0a1f12 40%, #071410 100%); }
        .custom-scroll::-webkit-scrollbar { height: 4px; width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
        [data-tooltip]:hover::after {
            content: attr(data-tooltip); position: absolute; bottom: calc(100% + 6px); left: 50%;
            transform: translateX(-50%); background: #1e293b; color: #f1f5f9; font-size: 11px;
            font-weight: 600; padding: 4px 8px; border-radius: 6px;
            white-space: nowrap; z-index: 100; pointer-events: none;
        }
        [data-tooltip] { position: relative; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.4s ease-out forwards; }
        .fade-up-delay-1 { animation: fadeUp 0.4s 0.08s ease-out both; }
        .fade-up-delay-2 { animation: fadeUp 0.4s 0.16s ease-out both; }
        tbody tr { transition: background-color 0.15s ease; }
        .avatar-gradient-0 { background: linear-gradient(135deg, #059669, #10b981); }
        .avatar-gradient-1 { background: linear-gradient(135deg, #7c3aed, #8b5cf6); }
        .avatar-gradient-2 { background: linear-gradient(135deg, #dc2626, #ef4444); }
        .avatar-gradient-3 { background: linear-gradient(135deg, #d97706, #f59e0b); }
        .avatar-gradient-4 { background: linear-gradient(135deg, #0284c7, #0ea5e9); }
        .avatar-gradient-5 { background: linear-gradient(135deg, #be185d, #ec4899); }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

<div id="mobile-overlay" class="fixed inset-0 z-[90] hidden" style="background:rgba(0,0,0,0.5);backdrop-filter:blur(2px);" onclick="closeMobileSidebar()"></div>

<div class="flex h-screen w-full overflow-hidden">

    {{-- SIDEBAR --}}
    <aside id="main-sidebar" class="fixed md:static inset-y-0 left-0 z-[100] flex flex-col w-72 md:w-64 lg:w-72 -translate-x-full md:translate-x-0 transition-transform duration-300 ease-out h-full overflow-y-auto shrink-0 shadow-2xl shadow-black/50">
        <div class="flex-shrink-0 px-6 py-5 border-b border-white/8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-xl shadow-lg flex-shrink-0">⛺</div>
                <div>
                    <h1 class="text-white font-black text-base tracking-wide leading-none">Gedoy<span style="color:#f0c96a">Admin</span></h1>
                    <p class="text-emerald-500 text-[9px] font-bold uppercase tracking-widest mt-0.5">Extranet System v1.0</p>
                </div>
            </div>
        </div>
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            <p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700 mb-2">Navigasi Utama</p>
            <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">📊</span>Dashboard Utama
            </a>
            <a href="{{ route('admin.packages.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">⛺</span>Manajemen Paket
            </a>
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">💰</span>Laporan Keuangan
            </a>
            <a href="{{ route('admin.customers.index') }}" class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">👥</span>Data Pelanggan
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🖼️</span>Galeri & Konten
            </a>
            <div class="pt-3 pb-1"><p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700">Sistem</p></div>
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🌐</span>Lihat Website Publik
                <svg class="w-3 h-3 ml-auto text-emerald-700 group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
            <a href="{{ route('admin.restaurant.index') }}"
               class="{{ Request::routeIs('admin.restaurant.*') ? 'nav-active' : 'text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🍳</span>
                Restoran Gedoy
            </a>
            <a href="{{ route('admin.restaurant_orders.index') }}"
               class="{{ Request::routeIs('admin.restaurant_orders.*') ? 'nav-active' : 'text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">📋</span>
                Pesanan Makanan
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">⚙️</span>Pengaturan Sistem
            </a>
        </nav>
        <div class="flex-shrink-0 px-4 py-4 border-t border-white/8">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-white/5 border border-white/8">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-gray-900 font-black text-sm flex-shrink-0 shadow">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <div class="min-w-0 flex-1">
                    <p class="text-white font-bold text-xs truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-emerald-500 text-[9px] font-bold uppercase tracking-wider mt-0.5">👑 Master Admin</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">@csrf
                    <button type="submit" data-tooltip="Logout" class="w-7 h-7 rounded-lg bg-white/5 hover:bg-red-500/20 border border-white/10 hover:border-red-500/30 flex items-center justify-center text-emerald-400 hover:text-red-400 transition-all duration-200 text-xs">🚪</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">

        {{-- HEADER --}}
        <header class="flex-shrink-0 h-14 bg-white border-b border-slate-200/80 flex items-center justify-between px-4 md:px-6 shadow-sm z-20">
            <div class="flex items-center gap-3">
                <button onclick="openMobileSidebar()" class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="flex items-center gap-2 text-xs">
                    <span class="hidden sm:inline text-slate-400 font-medium">Gedoy Camping</span>
                    <span class="hidden sm:inline text-slate-200">/</span>
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Data Pelanggan</span>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="hidden sm:flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></span>
                    <span class="text-emerald-700 text-[10px] font-bold uppercase tracking-wider">Live · PostgreSQL</span>
                </div>
                <div class="hidden md:block text-xs text-slate-400 font-medium"><span id="live-clock"></span></div>
                <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>
                <a href="{{ route('home') }}" class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">🌐 Publik</a>
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">@csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg transition-all duration-200">Logout</button>
                </form>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto custom-scroll bg-slate-50 px-4 md:px-6 lg:px-8 py-6 space-y-6">

            {{-- Title + Search --}}
            <div class="fade-up flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                        Data Pelanggan
                        <span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">& Pengunjung</span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-1 font-medium">Daftar seluruh akun pengguna yang terdaftar di sistem Gedoy Camping Park</p>
                </div>

                {{-- Search --}}
                <div class="relative flex-shrink-0">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="customer-search" placeholder="Cari nama, email, atau telepon..."
                           class="pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium bg-white shadow-sm w-64 transition-all">
                </div>
            </div>

            {{-- Stats --}}
            <div class="fade-up-delay-1 grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Total Pengguna</p>
                    <p class="text-2xl font-black text-slate-900">{{ $customers->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Sudah Booking</p>
                    <p class="text-2xl font-black text-emerald-600">{{ $customers->filter(fn($c) => $c->bookings_count > 0)->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Belum Booking</p>
                    <p class="text-2xl font-black text-slate-400">{{ $customers->filter(fn($c) => $c->bookings_count == 0)->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Total Reservasi</p>
                    <p class="text-2xl font-black text-blue-600">{{ $customers->sum('bookings_count') }}</p>
                </div>
            </div>

            {{-- Customer Table --}}
            <div class="fade-up-delay-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-black text-slate-900">Daftar Pelanggan Terdaftar</h2>
                        <p class="text-slate-400 text-xs mt-0.5">Menampilkan <span id="visible-customer-count" class="font-bold text-slate-600">{{ $customers->count() }}</span> dari {{ $customers->count() }} pengguna</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">#</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">No. Telepon</th>
                                <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-wider">Total Reservasi</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody id="customer-table-body" class="divide-y divide-slate-50">
                            @forelse($customers as $i => $customer)
                                @php
                                    $bookingCount = $customer->bookings_count ?? 0;
                                    $gradientClass = 'avatar-gradient-' . ($i % 6);
                                    // Get phone from bookings if not on user model
                                    $phone = $customer->phone ?? ($customer->bookings->first()->customer_phone ?? null);
                                @endphp
                                <tr class="customer-row hover:bg-slate-50/80 transition-colors"
                                    data-search="{{ strtolower($customer->name . ' ' . $customer->email . ' ' . ($phone ?? '')) }}">
                                    <td class="px-6 py-4 text-xs text-slate-400 font-bold">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl {{ $gradientClass }} flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $customer->name }}</p>
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full
                                                    {{ $customer->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-500' }}">
                                                    {{ $customer->role === 'admin' ? '👑 Admin' : '👤 Pelanggan' }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-600 font-medium">
                                        <a href="mailto:{{ $customer->email }}" class="hover:text-emerald-700 transition-colors">{{ $customer->email }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-600 font-medium">
                                        @if($phone)
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $phone) }}" target="_blank"
                                               class="flex items-center gap-1.5 hover:text-emerald-700 transition-colors">
                                                <span>📱</span> {{ $phone }}
                                            </a>
                                        @else
                                            <span class="text-slate-300 italic text-[11px]">–</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($bookingCount > 0)
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-emerald-100 border border-emerald-200 text-emerald-700 font-black text-sm">
                                                {{ $bookingCount }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-100 border border-slate-200 text-slate-400 font-black text-sm">0</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-500 font-medium">
                                        {{ \Carbon\Carbon::parse($customer->created_at)->isoFormat('D MMM YYYY') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="text-4xl mb-3">👥</div>
                                        <p class="text-sm font-bold text-slate-500">Belum ada pelanggan terdaftar</p>
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

<script>
(function () {
    const clockEl = document.getElementById('live-clock');
    function updateClock() {
        if (!clockEl) return;
        clockEl.textContent = [new Date().getHours(), new Date().getMinutes(), new Date().getSeconds()].map(v=>String(v).padStart(2,'0')).join(':');
    }
    updateClock(); setInterval(updateClock, 1000);
    window.openMobileSidebar = function () {
        document.getElementById('main-sidebar').classList.remove('-translate-x-full');
        document.getElementById('mobile-overlay').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };
    window.closeMobileSidebar = function () {
        document.getElementById('main-sidebar').classList.add('-translate-x-full');
        document.getElementById('mobile-overlay').classList.add('hidden');
        document.body.style.overflow = '';
    };

    // Live search
    const searchInput = document.getElementById('customer-search');
    const countEl = document.getElementById('visible-customer-count');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.customer-row');
            let visible = 0;
            rows.forEach(row => {
                const match = !q || (row.dataset.search && row.dataset.search.includes(q));
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            if (countEl) countEl.textContent = visible;
        });
    }
    document.addEventListener('keydown', e => { if (e.key==='Escape') closeMobileSidebar(); });
})();
</script>
</body>
</html>
