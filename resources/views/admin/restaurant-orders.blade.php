<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Kelola Pesanan Restoran – Gedoy Camping Park</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .nav-active {
            background: linear-gradient(135deg, rgba(245,158,11,0.15) 0%, rgba(245,158,11,0.05) 100%);
            border: 1px solid rgba(245,158,11,0.3);
            color: #f59e0b;
        }
        aside::-webkit-scrollbar { width: 3px; }
        aside::-webkit-scrollbar-track { background: transparent; }
        aside::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }
        aside { background: linear-gradient(180deg, #071410 0%, #0a1f12 40%, #071410 100%); }
        .custom-scroll::-webkit-scrollbar { height: 4px; width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute; bottom: calc(100% + 6px); left: 50%;
            transform: translateX(-50%);
            background: #1e293b; color: #f1f5f9; font-size: 11px;
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

        /* Modal styling */
        .modal-backdrop {
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
        }
        .pulse-soft {
            animation: softPulse 2s ease-in-out infinite;
        }
        @keyframes softPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.7; transform: scale(0.97); }
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

{{-- Mobile overlay --}}
<div id="mobile-overlay" class="fixed inset-0 z-[90] hidden"
     style="background: rgba(0,0,0,0.5); backdrop-filter: blur(2px);"
     onclick="closeMobileSidebar()"></div>

{{-- ================================================================
     MAIN SHELL
================================================================ --}}
<div class="flex h-screen w-full overflow-hidden">

    {{-- ============================================================
         SIDEBAR
    ============================================================ --}}
    <aside id="main-sidebar"
           class="fixed md:static inset-y-0 left-0 z-[100] flex flex-col w-72 md:w-64 lg:w-72
                  -translate-x-full md:translate-x-0 transition-transform duration-300 ease-out
                  h-full overflow-y-auto shrink-0 shadow-2xl shadow-black/50">

        {{-- Brand --}}
        <div class="flex-shrink-0 px-6 py-5 border-b border-white/8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-xl shadow-lg flex-shrink-0">⛺</div>
                <div>
                    <h1 class="text-white font-black text-base tracking-wide leading-none">Gedoy<span style="color:#f0c96a">Admin</span></h1>
                    <p class="text-emerald-500 text-[9px] font-bold uppercase tracking-widest mt-0.5">Extranet System v1.0</p>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            <p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700 mb-2">Navigasi Utama</p>

            <a href="{{ route('admin.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">📊</span>
                Dashboard Utama
            </a>

            <a href="{{ route('admin.packages.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">⛺</span>
                Manajemen Paket
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">💰</span>
                Laporan Keuangan
            </a>

            <a href="{{ route('admin.customers.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">👥</span>
                Data Pelanggan
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🖼️</span>
                Galeri & Konten
            </a>

            <a href="{{ route('admin.restaurant.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🍳</span>
                Restoran Gedoy
            </a>

            <a href="{{ route('admin.restaurant_orders.index') }}"
               class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">📋</span>
                Pesanan Makanan
            </a>

            <div class="pt-3 pb-1">
                <p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700">Sistem</p>
            </div>

            <a href="{{ route('home') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">🌐</span>
                Lihat Website Publik
                <svg class="w-3 h-3 ml-auto text-emerald-700 group-hover:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
            </a>

            <a href="{{ route('admin.settings.index') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">⚙️</span>
                Pengaturan Sistem
            </a>
        </nav>

        {{-- User footer --}}
        <div class="flex-shrink-0 px-4 py-4 border-t border-white/8">
            <div class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-white/5 border border-white/8">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-gray-900 font-black text-sm flex-shrink-0 shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-white font-bold text-xs truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-emerald-500 text-[9px] font-bold uppercase tracking-wider mt-0.5">👑 Master Admin</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                    @csrf
                    <button type="submit" data-tooltip="Logout"
                            class="w-7 h-7 rounded-lg bg-white/5 hover:bg-red-500/20 border border-white/10 hover:border-red-500/30 flex items-center justify-center text-emerald-400 hover:text-red-400 transition-all duration-200 text-xs">
                        🚪
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ============================================================
         MAIN CONTENT AREA
    ============================================================ --}}
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">

        {{-- TOP HEADER --}}
        <header class="flex-shrink-0 h-14 bg-white border-b border-slate-200/80 flex items-center justify-between px-4 md:px-6 shadow-sm z-20">
            <div class="flex items-center gap-3">
                <button onclick="openMobileSidebar()" id="hamburger-btn"
                        class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="flex items-center gap-2 text-xs">
                    <span class="hidden sm:inline text-slate-400 font-medium">Gedoy Camping</span>
                    <span class="hidden sm:inline text-slate-200">/</span>
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Kelola Pesanan Restoran</span>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="hidden sm:flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></span>
                    <span class="text-emerald-700 text-[10px] font-bold uppercase tracking-wider">Live · PostgreSQL</span>
                </div>
                <div class="hidden md:block text-xs text-slate-400 font-medium"><span id="live-clock"></span></div>
                <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>
                <a href="{{ route('restaurant.index') }}" target="_blank" class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">🌐 Publik</a>
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg transition-all duration-200">Logout</button>
                </form>
            </div>
        </header>

        {{-- SCROLLABLE CONTENT --}}
        <main class="flex-1 overflow-y-auto custom-scroll bg-slate-50 px-4 md:px-6 lg:px-8 py-6 relative">

            {{-- Flash Alert --}}
            @if(session('success'))
                <div id="restoran-alert" class="fade-up flex items-center gap-4 bg-white border border-emerald-200 rounded-2xl shadow-sm px-5 py-3.5 mb-6">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-base flex-shrink-0">✨</div>
                    <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                    <button type="button" onclick="document.getElementById('restoran-alert').remove()" class="flex-shrink-0 text-slate-300 hover:text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            {{-- Workspace Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl text-emerald-950 font-bold leading-tight">Dashboard Pengelolaan Pesanan Restoran</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Data real-time dari database PostgreSQL - Diperbarui setiap refresh halaman</p>
                </div>
                <a href="{{ route('admin.restaurant_orders.index') }}"
                   class="inline-flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold text-sm px-5 py-2.5 rounded-xl shadow transition duration-200">
                    🔄 Refresh Halaman
                </a>
            </div>

            {{-- Stat Cards Row --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                {{-- Card 1: Total Orders --}}
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-3xl p-6 shadow-sm relative flex flex-col justify-between min-h-[140px]">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center text-base">📋</span>
                            
                            {{-- Dropdown Filter Form --}}
                            <form action="{{ route('admin.restaurant_orders.index') }}" method="GET" id="range-form" class="inline-block">
                                <select name="range" onchange="document.getElementById('range-form').submit()"
                                        class="text-[10px] font-bold uppercase tracking-wider text-blue-800 bg-white border border-blue-200 rounded-lg px-2 py-1 focus:outline-none cursor-pointer">
                                    <option value="all" {{ $range === 'all' ? 'selected' : '' }}>Semua Waktu</option>
                                    <option value="today" {{ $range === 'today' ? 'selected' : '' }}>Hari Ini</option>
                                    <option value="week" {{ $range === 'week' ? 'selected' : '' }}>7 Hari Terakhir</option>
                                    <option value="month" {{ $range === 'month' ? 'selected' : '' }}>30 Hari Terakhir</option>
                                </select>
                            </form>
                        </div>
                        <span class="text-[10px] text-blue-500 font-bold uppercase tracking-wider block">Total Pesanan</span>
                        <h3 class="font-serif-luxury text-3xl font-black text-slate-800 mt-1">
                            {{ $totalOrdersCount }} <span class="text-xs text-slate-400 font-bold">Pesanan</span>
                        </h3>
                    </div>
                    <p class="text-[9px] text-blue-400/90 mt-2 font-semibold">Berdasarkan filter waktu terpilih</p>
                </div>

                {{-- Card 2: Menunggu Validasi --}}
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 border border-amber-200 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[140px]">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-9 h-9 rounded-xl bg-amber-500/10 flex items-center justify-center text-base">⏳</span>
                        </div>
                        <span class="text-[10px] text-amber-600 font-bold uppercase tracking-wider block">Menunggu Validasi</span>
                        <h3 class="font-serif-luxury text-3xl font-black text-slate-800 mt-1">
                            {{ $pendingCount }} <span class="text-xs text-slate-400 font-bold">Antrean</span>
                        </h3>
                    </div>
                    <p class="text-[9px] text-amber-600/70 mt-2 font-semibold">
                        {{ $pendingCount > 0 ? 'Segera respon pesanan masuk' : 'Semua pesanan sudah ditangani' }}
                    </p>
                </div>

                {{-- Card 3: Pendapatan Bersih --}}
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 border border-emerald-200 rounded-3xl p-6 shadow-sm flex flex-col justify-between min-h-[140px]">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center text-base">💰</span>
                            <span class="text-[9px] bg-emerald-500/10 text-emerald-800 border border-emerald-200 px-2 py-0.5 rounded-full font-bold uppercase">Selesai</span>
                        </div>
                        <span class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider block">Pendapatan Bersih</span>
                        <h3 class="font-serif-luxury text-2xl font-black text-slate-800 mt-1">
                            Rp {{ number_format($netRevenue, 0, ',', '.') }}
                        </h3>
                    </div>
                    <p class="text-[9px] text-emerald-600/70 mt-2 font-semibold">Pemasukan dari pesanan Selesai Diantar</p>
                </div>

            </div>

            {{-- Table Filter Section --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-6 mb-6 border-b border-slate-200">
                <div>
                    <h3 class="font-bold text-slate-900 text-lg leading-tight">Daftar Transaksi Pesanan Makanan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Kelola status pesanan, lakukan pembatalan, atau validasi hidangan.</p>
                </div>

                {{-- Status filters (JS-based filter) --}}
                <div class="flex flex-wrap items-center gap-1.5 bg-slate-100 p-1 rounded-xl border border-slate-200">
                    <button onclick="filterOrders('all')" id="btn-filter-all"
                            class="filter-btn text-xs font-bold px-4 py-2 rounded-lg bg-white text-emerald-800 shadow-sm border border-emerald-100">
                        Semua
                    </button>
                    <button onclick="filterOrders('pending')" id="btn-filter-pending"
                            class="filter-btn text-xs font-semibold px-4 py-2 rounded-lg text-slate-600 hover:bg-white/60 transition">
                        Menunggu
                    </button>
                    <button onclick="filterOrders('processing')" id="btn-filter-processing"
                            class="filter-btn text-xs font-semibold px-4 py-2 rounded-lg text-slate-600 hover:bg-white/60 transition">
                        Dimasak
                    </button>
                    <button onclick="filterOrders('completed')" id="btn-filter-completed"
                            class="filter-btn text-xs font-semibold px-4 py-2 rounded-lg text-slate-600 hover:bg-white/60 transition">
                        Selesai
                    </button>
                    <button onclick="filterOrders('cancelled')" id="btn-filter-cancelled"
                            class="filter-btn text-xs font-semibold px-4 py-2 rounded-lg text-slate-600 hover:bg-white/60 transition">
                        Batal
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-16">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-4 px-6">Order ID</th>
                                <th class="py-4 px-6">Pelanggan</th>
                                <th class="py-4 px-6">Detail Hidangan</th>
                                <th class="py-4 px-6">Lokasi Antar</th>
                                <th class="py-4 px-6">Waktu Antar</th>
                                <th class="py-4 px-6">Total Bayar</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($orders as $order)
                                <tr class="order-row hover:bg-slate-50/60 transition-colors" data-status="{{ $order->status }}">
                                    {{-- ID --}}
                                    <td class="py-4 px-6 font-bold text-slate-900">
                                        #GDY-FB-{{ $order->id }}
                                        <span class="block text-[10px] text-slate-400 font-normal mt-0.5">{{ $order->created_at->format('d/m/y, H:i') }}</span>
                                    </td>

                                    {{-- Pelanggan --}}
                                    <td class="py-4 px-6">
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">{{ $order->user->name ?? 'Pelanggan' }}</p>
                                            <p class="text-xs text-slate-400 font-medium mt-0.5">{{ $order->user->email ?? '-' }}</p>
                                        </div>
                                    </td>

                                    {{-- Hidangan --}}
                                    <td class="py-4 px-6">
                                        <div class="space-y-1">
                                            @foreach($order->items as $item)
                                                <div class="flex items-center gap-1.5 text-xs text-slate-600 font-medium">
                                                    <span class="w-5 h-5 rounded bg-slate-100 flex items-center justify-center font-bold text-slate-700 text-[10px] border border-slate-200">{{ $item->quantity }}x</span>
                                                    <span>{{ $item->menu->name ?? 'Menu Terhapus' }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>

                                    {{-- Tenda --}}
                                    <td class="py-4 px-6 font-semibold text-slate-700">
                                        ⛺ {{ $order->tenda_number }}
                                    </td>

                                    {{-- Waktu --}}
                                    <td class="py-4 px-6 font-semibold text-slate-700">
                                        🕐 {{ $order->delivery_time }}
                                    </td>

                                    {{-- Total --}}
                                    <td class="py-4 px-6 font-black text-emerald-800">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        <span class="block text-[9px] text-slate-400 font-normal mt-0.5">Sudah Pajak 11%</span>
                                    </td>

                                    {{-- Status --}}
                                    <td class="py-4 px-6">
                                        @if($order->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200 pulse-soft">
                                                ⏳ Pending
                                            </span>
                                        @elseif($order->status === 'processing')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                                👨‍🍳 Dimasak
                                            </span>
                                        @elseif($order->status === 'completed')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                ✅ Selesai
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                                ❌ Batal
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center justify-end gap-1.5">
                                            @if($order->status === 'pending')
                                                {{-- Approve to cooking --}}
                                                <form action="{{ route('admin.restaurant_orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="processing">
                                                    <button type="submit" data-tooltip="Setujui & Masak"
                                                            class="w-9 h-9 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white flex items-center justify-center font-bold shadow-sm transition">
                                                        🍳
                                                    </button>
                                                </form>

                                                {{-- Cancel --}}
                                                <button onclick="openCancelModal('{{ $order->id }}', '{{ $order->user->name ?? 'Pelanggan' }}')"
                                                        class="w-9 h-9 rounded-xl bg-red-50 hover:bg-red-100 border border-red-100 text-red-600 flex items-center justify-center font-bold shadow-sm transition"
                                                        title="Batalkan Pesanan">
                                                    ✕
                                                </button>
                                            @elseif($order->status === 'processing')
                                                {{-- Complete and Deliver --}}
                                                <form action="{{ route('admin.restaurant_orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" data-tooltip="Selesai Diantar"
                                                            class="w-9 h-9 rounded-xl bg-blue-600 hover:bg-blue-700 text-white flex items-center justify-center font-bold shadow-sm transition">
                                                        🚚
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Delete --}}
                                            <button onclick="openDeleteModal('{{ $order->id }}')"
                                                    class="w-9 h-9 rounded-xl border border-slate-200 hover:border-red-200 bg-white hover:bg-red-50 text-slate-500 hover:text-red-600 flex items-center justify-center transition shadow-sm"
                                                    title="Hapus Pesanan Permanen">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center text-slate-400">
                                        <span class="text-3xl block mb-2">🥗</span>
                                        Belum ada pesanan makanan yang masuk.
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

{{-- ================================================================
     MODALS SECTION
================================================================ --}}

{{-- Cancel Confirmation Modal --}}
<div id="modal-cancel" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center text-3xl mx-auto mb-5">❌</div>
        <h3 class="text-xl font-bold text-slate-900 mb-2 font-serif-luxury">Batalkan Pesanan</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan membatalkan pesanan milik pelanggan:</p>
        <p id="modal-cancel-name" class="text-slate-900 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <p class="text-slate-400 text-xs mb-6">Status pesanan akan diubah menjadi <strong class="text-rose-500">Dibatalkan</strong>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-cancel')"
                    class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition cursor-pointer">
                Batal
            </button>
            <form id="cancel-form" method="POST" class="flex-1">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm transition shadow-lg shadow-rose-600/30 cursor-pointer">
                    Ya, Batalkan
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Order Modal --}}
<div id="modal-delete" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center text-3xl mx-auto mb-5">🗑️</div>
        <h3 class="text-xl font-bold text-slate-900 mb-2 font-serif-luxury">Hapus Pesanan Permanen</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan menghapus data pesanan restoran ini:</p>
        <p id="modal-delete-code" class="text-slate-950 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <p class="text-slate-400 text-xs mb-6">Tindakan ini akan menghapus data dari sistem secara permanen.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete')"
                    class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition cursor-pointer">
                Batal
            </button>
            <form id="delete-form" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm transition shadow-lg shadow-rose-600/30 cursor-pointer">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- ================================================================
     SCRIPTS & INTERACTIONS
================================================================ --}}
<script>
    // Live Clock for Header Bar
    function updateClock() {
        const clockEl = document.getElementById('live-clock');
        if (clockEl) {
            const now = new Date();
            const dateStr = now.toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'short' });
            const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            clockEl.innerText = `${dateStr} · ${timeStr} WIB`;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();

    // Mobile Sidebar controls
    function openMobileSidebar() {
        document.getElementById('main-sidebar').classList.remove('-translate-x-full');
        document.getElementById('mobile-overlay').classList.remove('hidden');
    }

    function closeMobileSidebar() {
        document.getElementById('main-sidebar').classList.add('-translate-x-full');
        document.getElementById('mobile-overlay').classList.add('hidden');
    }

    // Filter list rows based on status selected
    function filterOrders(status) {
        // Update tab buttons styles
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.className = "filter-btn text-xs font-semibold px-4 py-2 rounded-lg text-slate-600 hover:bg-white/60 transition";
        });
        const activeBtn = document.getElementById('btn-filter-' + status);
        if (activeBtn) {
            activeBtn.className = "filter-btn text-xs font-bold px-4 py-2 rounded-lg bg-white text-emerald-800 shadow-sm border border-emerald-100";
        }

        // Show/hide rows
        document.querySelectorAll('.order-row').forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Modal Helpers
    function openCancelModal(id, name) {
        document.getElementById('modal-cancel-name').innerText = name + ' (#' + id + ')';
        const form = document.getElementById('cancel-form');
        form.action = `/admin/restaurant-orders/${id}/status`;
        document.getElementById('modal-cancel').classList.remove('hidden');
    }

    function openDeleteModal(id) {
        document.getElementById('modal-delete-code').innerText = 'Pesanan #' + id;
        const form = document.getElementById('delete-form');
        form.action = `/admin/restaurant-orders/${id}`;
        document.getElementById('modal-delete').classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    // Auto-dismiss alert
    setTimeout(() => {
        const alert = document.getElementById('restoran-alert');
        if (alert) {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            alert.style.transition = 'all 0.3s ease';
            setTimeout(() => alert.remove(), 300);
        }
    }, 5000);
</script>

</body>
</html>
