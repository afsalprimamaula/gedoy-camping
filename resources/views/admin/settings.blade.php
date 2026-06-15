<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Pengaturan Sistem – Gedoy Camping Park</title>

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

            <a href="{{ route('admin.settings.index') }}"
               class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">⚙️</span>
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
         MAIN CONTENT
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
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Pengaturan Sistem</span>
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
                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg transition-all duration-200">Logout</button>
                </form>
            </div>
        </header>

        {{-- SCROLLABLE CONTENT --}}
        <main class="flex-1 overflow-y-auto custom-scroll bg-slate-50 px-4 md:px-6 lg:px-8 py-6 relative">

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 pb-24">
                @csrf
                @method('PUT')

                {{-- Flash Alert --}}
                @if(session('success'))
                    <div id="settings-alert" class="fade-up flex items-center gap-4 bg-white border border-emerald-200 rounded-2xl shadow-sm px-5 py-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-base flex-shrink-0">✨</div>
                        <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                        <button type="button" onclick="document.getElementById('settings-alert').remove()" class="flex-shrink-0 text-slate-300 hover:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="fade-up bg-red-50 border border-red-200 rounded-2xl p-4 text-red-800 text-sm space-y-1">
                        <p class="font-bold">⚠️ Terdapat kesalahan pengisian data:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Page Title --}}
                <div class="fade-up flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                            Pengaturan Sistem
                            <span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">&amp; Konfigurasi</span>
                        </h1>
                        <p class="text-slate-400 text-xs mt-1 font-medium">Kelola informasi dasar platform, rekening pembayaran, dan status operasional sistem.</p>
                    </div>
                </div>

                {{-- Two-Column Layout Grid --}}
                <div class="fade-up-delay-1 grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- Left Column: Summary Info --}}
                    <div class="lg:sticky lg:top-4 space-y-6">
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider mb-4">Ringkasan Sistem</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                                    <span class="text-xs text-slate-400 font-medium">Status Operasional</span>
                                    @if(($configs['sys_status'] ?? 'open') === 'open')
                                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider">Buka Normal</span>
                                    @else
                                        <span class="bg-amber-100 text-amber-800 text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider">Tutup Sementara</span>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                                    <span class="text-xs text-slate-400 font-medium">Website Utama</span>
                                    <span class="text-xs text-slate-700 font-bold">{{ $configs['web_name'] ?? 'Gedoy Camping Park' }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                                    <span class="text-xs text-slate-400 font-medium">No. WhatsApp Admin</span>
                                    <span class="text-xs text-slate-700 font-bold">+{{ $configs['whatsapp_number'] ?? '6281222099317' }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                                    <span class="text-xs text-slate-400 font-medium">Uang Muka (DP)</span>
                                    <span class="text-xs text-slate-700 font-bold">{{ $configs['dp_percentage'] ?? '30' }}%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-slate-400 font-medium">Metode Transfer</span>
                                    <span class="text-xs text-slate-700 font-bold">{{ $configs['bank_name'] ?? 'BCA' }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Navigation --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-3">
                            <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">Navigasi Cepat</h3>
                            <div class="flex flex-col gap-2">
                                <a href="#platform-info" class="text-xs text-emerald-700 hover:text-emerald-900 font-bold flex items-center gap-2 transition-colors">
                                    <span>👉</span> Informasi Platform
                                </a>
                                <a href="#transaction-settings" class="text-xs text-emerald-700 hover:text-emerald-900 font-bold flex items-center gap-2 transition-colors">
                                    <span>👉</span> Pengaturan Transaksi &amp; DP
                                </a>
                                <a href="#operational-status" class="text-xs text-emerald-700 hover:text-emerald-900 font-bold flex items-center gap-2 transition-colors">
                                    <span>👉</span> Status Operasional
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Form Cards --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Card 1: Informasi Platform --}}
                        <div id="platform-info" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden scroll-mt-6">
                            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">1. Informasi Platform</h2>
                                <p class="text-slate-400 text-xs mt-0.5">Konfigurasi teks publikasi website, email, dan detail media sosial.</p>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nama Website <span class="text-rose-500">*</span></label>
                                    <input type="text" name="web_name" required value="{{ old('web_name', $configs['web_name'] ?? 'Gedoy Camping Park') }}"
                                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Slogan Utama Website</label>
                                    <input type="text" name="web_slogan" value="{{ old('web_slogan', $configs['web_slogan'] ?? 'Glamping Premium di Tepi Sungai & Alam Terbuka Ciater') }}"
                                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Email Kontak Resmi <span class="text-rose-500">*</span></label>
                                        <input type="email" name="contact_email" required value="{{ old('contact_email', $configs['contact_email'] ?? 'info@gedoycamping.com') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nomor WhatsApp Admin <span class="text-rose-500">*</span></label>
                                        <p class="text-slate-400 text-[10px] mb-1">Gunakan format angka tanpa spasi/karakter. cth: 6281222099317</p>
                                        <input type="text" name="whatsapp_number" required value="{{ old('whatsapp_number', $configs['whatsapp_number'] ?? '6281222099317') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nomor Telepon Kontak</label>
                                        <input type="text" name="tel_number" value="{{ old('tel_number', $configs['tel_number'] ?? '+62 812-2209-9317') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Link Instagram Resmi</label>
                                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $configs['instagram_url'] ?? 'https://www.instagram.com/') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Alamat Fisik Kemah</label>
                                    <input type="text" name="address" value="{{ old('address', $configs['address'] ?? 'Kawasan Nagrak, Kecamatan Ciater, Kabupaten Subang') }}"
                                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Link Google Maps</label>
                                    <input type="text" name="maps_link" value="{{ old('maps_link', $configs['maps_link'] ?? '') }}" placeholder="https://maps.app.goo.gl/..."
                                           class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                </div>
                            </div>
                        </div>

                        {{-- Card 2: Pengaturan Transaksi & DP --}}
                        <div id="transaction-settings" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden scroll-mt-6">
                            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">2. Pengaturan Transaksi &amp; DP</h2>
                                <p class="text-slate-400 text-xs mt-0.5">Atur besaran persentase uang muka serta rekening tujuan transfer.</p>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Persentase Down Payment (%) <span class="text-rose-500">*</span></label>
                                    <input type="number" name="dp_percentage" required min="0" max="100" value="{{ old('dp_percentage', $configs['dp_percentage'] ?? '30') }}"
                                           class="w-24 px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nama Bank <span class="text-rose-500">*</span></label>
                                        <input type="text" name="bank_name" required value="{{ old('bank_name', $configs['bank_name'] ?? 'BCA') }}" placeholder="BCA / Mandiri"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nomor Rekening <span class="text-rose-500">*</span></label>
                                        <input type="text" name="bank_account" required value="{{ old('bank_account', $configs['bank_account'] ?? '1393019842') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Atas Nama (A/N) <span class="text-rose-500">*</span></label>
                                        <input type="text" name="bank_recipient" required value="{{ old('bank_recipient', $configs['bank_recipient'] ?? 'CV Gedoy Wisata Indonesia') }}"
                                               class="w-full px-4 py-3 bg-slate-50 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: Status Operasional --}}
                        <div id="operational-status" class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden scroll-mt-6">
                            <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                                <h2 class="text-sm font-black text-slate-900 uppercase tracking-wider">3. Status Operasional</h2>
                                <p class="text-slate-400 text-xs mt-0.5">Kontrol status sistem reservasi umum dan setelan penutupan darurat.</p>
                            </div>
                            <div class="p-6 space-y-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-2.5 uppercase tracking-wider">Status Reservasi</label>
                                    @php
                                        $currentStatus = old('sys_status', $configs['sys_status'] ?? 'open');
                                    @endphp
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <label class="flex items-center gap-3 border rounded-xl p-4 cursor-pointer transition-all hover:bg-slate-50 border-slate-200" id="label-status-open">
                                            <input type="radio" name="sys_status" id="status-open" value="open" 
                                                   {{ $currentStatus === 'open' ? 'checked' : '' }}
                                                   onchange="toggleClosedMessage()"
                                                   class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                                            <div>
                                                <p class="text-sm font-black text-slate-900 leading-tight">🟢 Buka Normal</p>
                                                <p class="text-slate-400 text-[11px] mt-0.5">Sistem reservasi dapat diakses pengunjung publik secara reguler.</p>
                                            </div>
                                        </label>
                                        <label class="flex items-center gap-3 border rounded-xl p-4 cursor-pointer transition-all hover:bg-slate-50 border-slate-200" id="label-status-closed">
                                            <input type="radio" name="sys_status" id="status-closed" value="closed" 
                                                   {{ $currentStatus === 'closed' ? 'checked' : '' }}
                                                   onchange="toggleClosedMessage()"
                                                   class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                                            <div>
                                                <p class="text-sm font-black text-slate-900 leading-tight">🔴 Tutup Sementara</p>
                                                <p class="text-slate-400 text-[11px] mt-0.5">Pendaftaran pesanan baru dinonaktifkan sementara.</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Pesan Penutupan Darurat</label>
                                    <p class="text-slate-400 text-[10px] mb-2">Pesan ini akan terlihat di landing page jika status diatur Tutup Sementara.</p>
                                    <textarea name="sys_closed_message" id="closed-message" rows="3" 
                                              class="w-full px-4 py-3 rounded-xl border border-slate-200 outline-none text-sm font-medium transition-all resize-none"
                                              placeholder="Tulis pesan penutupan di sini...">{{ old('sys_closed_message', $configs['sys_closed_message'] ?? 'Mohon maaf, Gedoy Camping Park sedang tutup sementara untuk pemeliharaan area kemah.') }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Action Footer (Sticky Bottom inside Workspace) --}}
                <div class="fixed bottom-0 right-0 left-0 md:left-64 lg:left-72 z-40 bg-white border-t border-slate-200 px-6 py-4 flex items-center justify-between shadow-lg">
                    <div class="max-w-7xl w-full mx-auto flex justify-between items-center">
                        <a href="{{ route('admin.index') }}"
                           class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm transition-all duration-200 shadow-md shadow-emerald-600/20 hover:-translate-y-0.5">
                            💾 Simpan Perubahan
                        </button>
                    </div>
                </div>

            </form>

        </main>
    </div>
</div>

<script>
(function () {
    // Clock
    const clockEl = document.getElementById('live-clock');
    function updateClock() {
        if (!clockEl) return;
        const now = new Date();
        const hh = String(now.getHours()).padStart(2,'0');
        const mm = String(now.getMinutes()).padStart(2,'0');
        const ss = String(now.getSeconds()).padStart(2,'0');
        clockEl.textContent = `${hh}:${mm}:${ss}`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // Mobile sidebar
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

    // Initialize text area toggle status
    window.toggleClosedMessage = function() {
        const closedRadio = document.getElementById('status-closed');
        const closedMessage = document.getElementById('closed-message');
        if (!closedRadio || !closedMessage) return;

        if (closedRadio.checked) {
            closedMessage.removeAttribute('disabled');
            closedMessage.classList.remove('bg-slate-100', 'text-slate-400');
            closedMessage.classList.add('bg-slate-50', 'text-slate-800');
        } else {
            closedMessage.setAttribute('disabled', 'true');
            closedMessage.classList.add('bg-slate-100', 'text-slate-400');
            closedMessage.classList.remove('bg-slate-50', 'text-slate-800');
        }
    };

    toggleClosedMessage();
})();

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeMobileSidebar();
    }
});
</script>
</body>
</html>
