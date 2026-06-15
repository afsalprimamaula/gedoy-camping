<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Laporan Keuangan – Gedoy Camping Park</title>
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
        @keyframes softPulse { 0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.7;transform:scale(0.96)} }
        .pulse-soft { animation: softPulse 2s ease-in-out infinite; }
        tbody tr { transition: background-color 0.15s ease; }
        .bar-fill { transition: width 1s ease-out; }

        /* Chart bars */
        .chart-bar {
            background: linear-gradient(to top, #059669, #10b981);
            border-radius: 6px 6px 0 0;
            transition: height 1s ease-out;
        }
        @keyframes barGrow {
            from { height: 0; }
        }
        .chart-bar { animation: barGrow 0.8s ease-out forwards; }
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
            <a href="{{ route('admin.reports.index') }}" class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">💰</span>Laporan Keuangan
            </a>
            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">👥</span>Data Pelanggan
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
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Laporan Keuangan</span>
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

            {{-- Title + Filter --}}
            <div class="fade-up flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                        Laporan
                        <span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">Keuangan</span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-1 font-medium">Rekap transaksi & pendapatan dari reservasi yang telah dikonfirmasi</p>
                </div>

                {{-- Filter + Export --}}
                <div class="flex flex-wrap items-center gap-3">
                    <form method="GET" action="{{ route('admin.reports.index') }}" class="flex items-center gap-2">
                        <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-xl px-3 py-2 shadow-sm">
                            <span class="text-slate-400 text-xs font-semibold whitespace-nowrap">Dari:</span>
                            <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}"
                                   class="text-xs font-semibold text-slate-700 outline-none border-none bg-transparent">
                            <span class="text-slate-300">–</span>
                            <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}"
                                   class="text-xs font-semibold text-slate-700 outline-none border-none bg-transparent">
                        </div>
                        <button type="submit" class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-sm">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                            Filter
                        </button>
                    </form>
                    <button onclick="window.print()" class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 text-slate-600 hover:text-blue-700 text-xs font-bold transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Export PDF
                    </button>
                    <a href="{{ route('admin.reports.export') }}?start_date={{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}&end_date={{ request('end_date', now()->format('Y-m-d')) }}"
                       class="flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-slate-200 hover:border-emerald-300 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 text-xs font-bold transition-all shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Export Excel
                    </a>
                </div>
            </div>

            {{-- Summary Cards --}}
            <div class="fade-up-delay-1 grid grid-cols-1 sm:grid-cols-3 gap-5">
                {{-- Omset Bulan Ini --}}
                <div class="bg-white rounded-2xl border border-emerald-100 p-6 shadow-sm relative overflow-hidden" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7);">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-emerald-400/10 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-xl shadow-sm">💵</div>
                            <span class="text-emerald-600 text-[10px] font-black uppercase tracking-wider bg-emerald-100 px-2.5 py-1 rounded-full">Bulan Ini</span>
                        </div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Omset Bulan Ini</p>
                        <p class="text-2xl font-black text-emerald-700">Rp {{ number_format($omsetBulanIni, 0, ',', '.') }}</p>
                        <p class="text-emerald-600 text-xs mt-1 font-medium">{{ $totalBulanIni }} transaksi selesai</p>
                    </div>
                </div>

                {{-- Total Pendapatan (filtered) --}}
                <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm relative overflow-hidden" style="background: linear-gradient(135deg, #eff6ff, #dbeafe);">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-blue-400/10 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-xl shadow-sm">📊</div>
                            <span class="text-blue-600 text-[10px] font-black uppercase tracking-wider bg-blue-100 px-2.5 py-1 rounded-full">Filter Aktif</span>
                        </div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-black text-blue-700">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-blue-600 text-xs mt-1 font-medium">{{ $confirmedBookings->count() }} transaksi dikonfirmasi</p>
                    </div>
                </div>

                {{-- Rata-rata Transaksi --}}
                <div class="bg-white rounded-2xl border border-amber-100 p-6 shadow-sm relative overflow-hidden" style="background: linear-gradient(135deg, #fffbeb, #fef3c7);">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-amber-400/10 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-xl shadow-sm">📈</div>
                            <span class="text-amber-600 text-[10px] font-black uppercase tracking-wider bg-amber-100 px-2.5 py-1 rounded-full">Rata-rata</span>
                        </div>
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-wider mb-1">Rata-rata Transaksi</p>
                        <p class="text-2xl font-black text-amber-700">Rp {{ $confirmedBookings->count() > 0 ? number_format($totalRevenue / $confirmedBookings->count(), 0, ',', '.') : '0' }}</p>
                        <p class="text-amber-600 text-xs mt-1 font-medium">per reservasi dikonfirmasi</p>
                    </div>
                </div>
            </div>

            {{-- Confirmed Bookings Table --}}
            <div class="fade-up-delay-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-black text-slate-900">Transaksi Terkonfirmasi</h2>
                        <p class="text-slate-400 text-xs mt-0.5">Hanya menampilkan reservasi dengan status <span class="text-emerald-600 font-bold">Disetujui</span></p>
                    </div>
                    <span class="bg-emerald-100 text-emerald-700 text-xs font-black px-3 py-1.5 rounded-xl">
                        {{ $confirmedBookings->count() }} Transaksi
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-100">
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">#</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Kode Booking</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Paket</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-wider">Tgl Keluar</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black text-slate-400 uppercase tracking-wider">Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($confirmedBookings as $i => $booking)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4 text-xs text-slate-400 font-bold">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4">
                                        <code class="text-[11px] font-black text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-lg tracking-wider">
                                            {{ $booking->booking_code }}
                                        </code>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-xl flex items-center justify-center text-white font-black text-xs flex-shrink-0" style="background: linear-gradient(135deg, #059669, #10b981);">
                                                {{ strtoupper(substr($booking->customer_name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-900 leading-tight">{{ $booking->customer_name }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium">{{ $booking->customer_email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-semibold text-slate-700">
                                        {{ $booking->campingPackage->name ?? '–' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs font-semibold text-slate-600">
                                        {{ \Carbon\Carbon::parse($booking->check_out_date)->isoFormat('D MMM YYYY') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-sm font-black text-emerald-700">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="text-4xl mb-3">📭</div>
                                        <p class="text-sm font-bold text-slate-500">Belum ada transaksi terkonfirmasi</p>
                                        <p class="text-xs text-slate-400 mt-1">pada rentang tanggal yang dipilih</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if($confirmedBookings->count() > 0)
                            <tfoot>
                                <tr class="bg-emerald-50 border-t-2 border-emerald-200">
                                    <td colspan="5" class="px-6 py-4 text-sm font-black text-emerald-800">Total Pendapatan</td>
                                    <td class="px-6 py-4 text-right text-base font-black text-emerald-700">
                                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
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
        const now = new Date();
        clockEl.textContent = [now.getHours(),now.getMinutes(),now.getSeconds()].map(v=>String(v).padStart(2,'0')).join(':');
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
    document.addEventListener('keydown', e => { if (e.key==='Escape') closeMobileSidebar(); });
})();
</script>
</body>
</html>
