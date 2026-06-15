<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Dashboard Admin – Gedoy Camping Park</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Sidebar active glow */
        .nav-active {
            background: linear-gradient(135deg, rgba(245,158,11,0.15) 0%, rgba(245,158,11,0.05) 100%);
            border: 1px solid rgba(245,158,11,0.3);
            color: #f59e0b;
        }

        /* Custom scrollbar for table area */
        .custom-scroll::-webkit-scrollbar { height: 4px; width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 2px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Sidebar scrollbar */
        aside::-webkit-scrollbar { width: 3px; }
        aside::-webkit-scrollbar-track { background: transparent; }
        aside::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

        /* Stat card gradient variants */
        .card-blue   { background: linear-gradient(135deg, #eff6ff, #dbeafe); border-color: #bfdbfe; }
        .card-amber  { background: linear-gradient(135deg, #fffbeb, #fef3c7); border-color: #fde68a; }
        .card-green  { background: linear-gradient(135deg, #f0fdf4, #dcfce7); border-color: #bbf7d0; }

        /* Row highlight animations */
        @keyframes rowHighlight {
            0%   { background-color: rgba(251,191,36,0.1); }
            100% { background-color: transparent; }
        }
        .row-new { animation: rowHighlight 2s ease-out forwards; }

        /* Modal backdrop */
        .modal-backdrop {
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
        }

        /* Sidebar gradient */
        aside {
            background: linear-gradient(180deg, #071410 0%, #0a1f12 40%, #071410 100%);
        }

        /* Table hover */
        tbody tr { transition: background-color 0.15s ease; }

        /* Badge pulse for pending */
        @keyframes softPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.7; transform: scale(0.96); }
        }
        .pulse-soft { animation: softPulse 2s ease-in-out infinite; }

        /* Tooltip */
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b;
            color: #f1f5f9;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
            white-space: nowrap;
            z-index: 100;
            pointer-events: none;
        }
        [data-tooltip] { position: relative; }

        /* Page transition */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.4s ease-out forwards; }
        .fade-up-delay-1 { animation: fadeUp 0.4s 0.08s ease-out both; }
        .fade-up-delay-2 { animation: fadeUp 0.4s 0.16s ease-out both; }
        .fade-up-delay-3 { animation: fadeUp 0.4s 0.24s ease-out both; }
    </style>
</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

{{-- ================================================================
     CONFIRM MODALS – Approve & Reject
================================================================ --}}
{{-- Approve Modal --}}
<div id="modal-approve" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-3xl mx-auto mb-5">✅</div>
        <h3 class="text-xl font-black text-slate-900 mb-2">Konfirmasi Reservasi</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan <strong class="text-emerald-700">menyetujui</strong> pesanan atas nama:</p>
        <p id="modal-approve-name" class="text-slate-900 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <p class="text-slate-400 text-xs mb-6">Pastikan pembayaran telah dikonfirmasi sebelum melanjutkan.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-approve')"
                    class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="modal-approve-form" method="POST" class="flex-1">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="confirmed">
                <button type="submit"
                        class="w-full py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition shadow-lg shadow-emerald-600/30">
                    Ya, Setujui
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Reject Modal --}}
<div id="modal-reject" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center text-3xl mx-auto mb-5">❌</div>
        <h3 class="text-xl font-black text-slate-900 mb-2">Tolak Reservasi</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan <strong class="text-rose-600">membatalkan</strong> pesanan atas nama:</p>
        <p id="modal-reject-name" class="text-slate-900 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <p class="text-slate-400 text-xs mb-6">Tindakan ini akan mengubah status menjadi <strong class="text-rose-500">Dibatalkan</strong>.</p>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-reject')"
                    class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="modal-reject-form" method="POST" class="flex-1">
                @csrf @method('PATCH')
                <input type="hidden" name="status" value="cancelled">
                <button type="submit"
                        class="w-full py-3 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-sm transition shadow-lg shadow-rose-600/30">
                    Ya, Batalkan
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div id="modal-delete" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl mx-auto mb-5">🗑️</div>
        <h3 class="text-xl font-black text-slate-900 mb-2">Hapus Data Permanen</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan <strong class="text-red-600">menghapus permanen</strong> data pesanan:</p>
        <p id="modal-delete-name" class="text-slate-900 font-bold text-base mb-2 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <div class="bg-red-50 border border-red-100 rounded-xl p-3 mb-6">
            <p class="text-red-600 text-xs font-semibold">⚠️ Tindakan ini tidak dapat dibatalkan. Data akan hilang dari database secara permanen.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="closeModal('modal-delete')"
                    class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="modal-delete-form" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition shadow-lg shadow-red-600/30">
                    Hapus Sekarang
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Close modals when clicking backdrop --}}
<script>
    function openModal(id, name, actionUrl) {
        document.getElementById('modal-' + id + '-name').textContent = name;
        document.getElementById('modal-' + id + '-form').action = actionUrl;
        document.getElementById('modal-' + id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = '';
    }
    // Close on backdrop click
    ['modal-approve','modal-reject','modal-delete'].forEach(id => {
        document.getElementById(id).addEventListener('click', function(e) {
            if (e.target === this) closeModal(id);
        });
    });
</script>


{{-- ================================================================
     MOBILE SIDEBAR OVERLAY
================================================================ --}}
<div id="mobile-overlay"
     class="fixed inset-0 z-[90] hidden"
     style="background: rgba(0,0,0,0.5); backdrop-filter: blur(2px);"
     onclick="closeMobileSidebar()"></div>


{{-- ================================================================
     MAIN SHELL – h-screen flex
================================================================ --}}
<div class="flex h-screen w-full overflow-hidden">

    {{-- ============================================================
         SIDEBAR – Fixed left navigation
    ============================================================ --}}
    <aside id="main-sidebar"
           class="fixed md:static inset-y-0 left-0 z-[100] flex flex-col w-72 md:w-64 lg:w-72
                  -translate-x-full md:translate-x-0 transition-transform duration-300 ease-out
                  h-full overflow-y-auto shrink-0 shadow-2xl shadow-black/50">

        {{-- Brand Header --}}
        <div class="flex-shrink-0 px-6 py-5 border-b border-white/8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-xl shadow-lg flex-shrink-0">
                    ⛺
                </div>
                <div>
                    <h1 class="text-white font-black text-base tracking-wide leading-none">
                        Gedoy<span style="color:#f0c96a">Admin</span>
                    </h1>
                    <p class="text-emerald-500 text-[9px] font-bold uppercase tracking-widest mt-0.5">
                        Extranet System v1.0
                    </p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">

            {{-- Section label --}}
            <p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700 mb-2">
                Navigasi Utama
            </p>

            <a href="{{ route('admin.index') }}"
               class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">📊</span>
                Dashboard Utama
                @if($pendingCount > 0)
                    <span class="ml-auto bg-amber-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full min-w-[18px] text-center pulse-soft">
                        {{ $pendingCount }}
                    </span>
                @endif
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
                Galeri &amp; Konten
            </a>

            <div class="pt-3 pb-1">
                <p class="px-3 text-[9px] font-black uppercase tracking-widest text-emerald-700">
                    Sistem
                </p>
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
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">⚙️</span>
                Pengaturan Sistem
            </a>
            {{-- Nav items now use prefix-based routes: admin.packages.index, admin.reports.index, etc --}}
        </nav>

        {{-- User Profile Footer --}}
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
                    <button type="submit"
                            data-tooltip="Logout"
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

        {{-- ── TOP HEADER BAR ─────────────────────────────────────── --}}
        <header class="flex-shrink-0 h-14 bg-white border-b border-slate-200/80 flex items-center justify-between px-4 md:px-6 shadow-sm z-20">

            {{-- Left: Hamburger (mobile) + Breadcrumb --}}
            <div class="flex items-center gap-3">
                {{-- Mobile sidebar toggle --}}
                <button onclick="openMobileSidebar()" id="hamburger-btn"
                        class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="flex items-center gap-2 text-xs">
                    <span class="hidden sm:inline text-slate-400 font-medium">Gedoy Camping</span>
                    <span class="hidden sm:inline text-slate-200">/</span>
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Dashboard Admin</span>
                </div>
            </div>

            {{-- Right: Status + actions --}}
            <div class="flex items-center gap-2 sm:gap-3">
                {{-- Live indicator --}}
                <div class="hidden sm:flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></span>
                    <span class="text-emerald-700 text-[10px] font-bold uppercase tracking-wider">Live · PostgreSQL</span>
                </div>

                {{-- Pending alert badge --}}
                @if($pendingCount > 0)
                    <div class="flex items-center gap-1.5 bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-lg pulse-soft">
                        <span class="text-amber-600 text-[10px] font-black">⏳ {{ $pendingCount }} Menunggu</span>
                    </div>
                @endif

                {{-- Date/time --}}
                <div class="hidden md:block text-xs text-slate-400 font-medium">
                    <span id="live-clock"></span>
                </div>

                <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>

                <a href="{{ route('home') }}"
                   class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">
                    🌐 Publik
                </a>

                <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                    @csrf
                    <button type="submit" class="text-xs font-bold text-rose-600 hover:text-white hover:bg-rose-600 border border-rose-200 px-3 py-1.5 rounded-lg transition-all duration-200">
                        Logout
                    </button>
                </form>
            </div>
        </header>


        {{-- ── SCROLLABLE CONTENT ──────────────────────────────────── --}}
        <main class="flex-1 overflow-y-auto custom-scroll bg-slate-50/50 px-4 md:px-6 lg:px-8 py-6 space-y-6">

            {{-- ─ Flash Alerts ───────────────────────────────────── --}}
            @if(session('success'))
                <div id="admin-alert"
                     class="fade-up flex items-center gap-4 bg-white border border-emerald-200 rounded-2xl shadow-sm px-5 py-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-base flex-shrink-0">✨</div>
                    <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                    <button onclick="document.getElementById('admin-alert').remove()"
                            class="flex-shrink-0 text-slate-300 hover:text-slate-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <script>setTimeout(() => { const el = document.getElementById('admin-alert'); if (el) { el.style.opacity = '0'; el.style.transition = 'opacity 0.3s'; setTimeout(() => el.remove(), 300); } }, 5000);</script>
            @endif


            {{-- ─ Page Title ──────────────────────────────────────── --}}
            <div class="fade-up flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                        Dashboard Pengelolaan
                        <span class="text-transparent bg-clip-text"
                              style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">
                            Reservasi
                        </span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-1 font-medium">
                        Data real-time dari database PostgreSQL · Diperbarui setiap refresh halaman
                    </p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <span class="text-xs text-slate-400 font-medium hidden lg:inline">
                        {{ now()->translatedFormat('l, d F Y') }}
                    </span>
                    <button onclick="window.location.reload()"
                            class="flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 bg-white hover:bg-emerald-50 border border-slate-200 hover:border-emerald-200 px-3 py-1.5 rounded-xl transition-all duration-200 shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Refresh
                    </button>
                </div>
            </div>


            {{-- ─ METRIC CARDS ─────────────────────────────────────── --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 fade-up-delay-1">

                {{-- Card 1: Total Bookings --}}
                <div class="card-blue relative bg-white rounded-2xl border p-5 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-blue-400/5 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-100 border border-blue-200 flex items-center justify-center text-xl shadow-sm">📅</div>
                            <div class="text-right">
                                <span class="inline-flex items-center gap-1 text-[9px] font-black uppercase tracking-widest text-blue-500 bg-blue-50 border border-blue-100 px-2 py-0.5 rounded-full">
                                    All Time
                                </span>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Total Reservasi</p>
                        <p class="text-3xl font-black text-slate-900 leading-none">
                            {{ $bookings->count() }}
                            <span class="text-sm font-semibold text-slate-400 ml-1">Pesanan</span>
                        </p>
                        <div class="mt-3 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <p class="text-xs text-slate-400 font-medium">
                                {{ $bookings->where('status', 'confirmed')->count() }} dikonfirmasi
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Pending Count --}}
                <div class="card-amber relative bg-white rounded-2xl border p-5 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-amber-400/5 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-amber-100 border border-amber-200 flex items-center justify-center text-xl shadow-sm {{ $pendingCount > 0 ? 'pulse-soft' : '' }}">⏳</div>
                            @if($pendingCount > 0)
                                <span class="inline-flex items-center gap-1 text-[9px] font-black uppercase tracking-widest text-amber-600 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded-full pulse-soft">
                                    Butuh Aksi
                                </span>
                            @endif
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Menunggu Validasi</p>
                        <p class="text-3xl font-black {{ $pendingCount > 0 ? 'text-amber-600' : 'text-slate-900' }} leading-none">
                            {{ $pendingCount }}
                            <span class="text-sm font-semibold text-slate-400 ml-1">Antrean</span>
                        </p>
                        <div class="mt-3 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full {{ $pendingCount > 0 ? 'bg-amber-400 animate-pulse' : 'bg-slate-300' }}"></span>
                            <p class="text-xs text-slate-400 font-medium">
                                {{ $pendingCount > 0 ? 'Segera tindak lanjuti' : 'Semua sudah ditangani' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 3: Total Revenue --}}
                <div class="card-green relative bg-white rounded-2xl border p-5 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-emerald-400/5 -translate-y-6 translate-x-6"></div>
                    <div class="relative">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-xl bg-emerald-100 border border-emerald-200 flex items-center justify-center text-xl shadow-sm">💰</div>
                            <span class="inline-flex items-center gap-1 text-[9px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-50 border border-emerald-100 px-2 py-0.5 rounded-full">
                                Confirmed Only
                            </span>
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Pendapatan Bersih</p>
                        <p class="text-2xl font-black text-emerald-700 leading-none">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                        <div class="mt-3 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <p class="text-xs text-slate-400 font-medium">
                                Dari {{ $bookings->where('status', 'confirmed')->count() }} transaksi selesai
                            </p>
                        </div>
                    </div>
                </div>

            </div>


            {{-- ─ QUICK STATUS FILTERS + SEARCH ──────────────────── --}}
            <div class="fade-up-delay-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                {{-- Table header with filters --}}
                <div class="px-5 py-4 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center gap-3">
                    <div class="flex-1">
                        <h2 class="font-black text-slate-900 text-base leading-tight">Manajemen Reservasi</h2>
                        <p class="text-slate-400 text-[11px] font-medium mt-0.5">
                            {{ $bookings->count() }} total data tersedia
                        </p>
                    </div>

                    <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">
                        {{-- Search bar --}}
                        <div class="relative flex-1 sm:flex-none">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                            </svg>
                            <input
                                type="text"
                                id="table-search"
                                placeholder="Cari nama, email, kode..."
                                class="pl-9 pr-4 py-2 text-xs font-medium border border-slate-200 rounded-xl bg-slate-50 text-slate-700 placeholder-slate-300 outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 transition-all w-44 sm:w-52">
                        </div>

                        {{-- Status filter tabs --}}
                        <div class="flex items-center rounded-xl border border-slate-200 bg-slate-50 p-0.5 text-[10px] font-bold">
                            <button onclick="filterTable('all')" id="filter-all"
                                    class="filter-btn px-3 py-1.5 rounded-lg transition-all duration-150 bg-white shadow-sm text-slate-700">
                                Semua
                            </button>
                            <button onclick="filterTable('pending')" id="filter-pending"
                                    class="filter-btn px-3 py-1.5 rounded-lg transition-all duration-150 text-slate-500 hover:text-slate-700">
                                Menunggu
                            </button>
                            <button onclick="filterTable('confirmed')" id="filter-confirmed"
                                    class="filter-btn px-3 py-1.5 rounded-lg transition-all duration-150 text-slate-500 hover:text-slate-700">
                                Disetujui
                            </button>
                            <button onclick="filterTable('cancelled')" id="filter-cancelled"
                                    class="filter-btn px-3 py-1.5 rounded-lg transition-all duration-150 text-slate-500 hover:text-slate-700">
                                Dibatalkan
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ─ DATA TABLE ──────────────────────────────────── --}}
                <div class="overflow-x-auto custom-scroll">
                    <table class="w-full text-left whitespace-nowrap" id="bookings-table">
                        <thead>
                            <tr class="text-slate-400 text-[10px] font-black uppercase tracking-widest border-b border-slate-100 bg-slate-50/80">
                                <th class="py-3.5 px-5">#</th>
                                <th class="py-3.5 px-5">Pelanggan</th>
                                <th class="py-3.5 px-5">Paket &amp; Tamu</th>
                                <th class="py-3.5 px-5">Durasi Menginap</th>
                                <th class="py-3.5 px-5">Total Bayar</th>
                                <th class="py-3.5 px-5 text-center">Status</th>
                                <th class="py-3.5 px-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50" id="table-body">
                            @forelse($bookings as $index => $booking)
                            <tr class="table-row hover:bg-slate-50/80 transition-colors duration-150 group"
                                data-status="{{ $booking->status }}"
                                data-search="{{ strtolower($booking->customer_name . ' ' . $booking->customer_email . ' ' . $booking->booking_code . ' ' . ($booking->campingPackage->name ?? '') ) }}">

                                {{-- # Index --}}
                                <td class="py-4 px-5">
                                    <span class="text-slate-300 text-xs font-bold">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </td>

                                {{-- Customer Info --}}
                                <td class="py-4 px-5 max-w-[220px]">
                                    <div class="flex items-start gap-3">
                                        {{-- Avatar --}}
                                        <div class="w-9 h-9 rounded-xl flex-shrink-0 flex items-center justify-center font-black text-xs shadow-sm
                                            {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700 border border-emerald-200' :
                                               ($booking->status === 'cancelled' ? 'bg-slate-100 text-slate-400 border border-slate-200' :
                                               'bg-amber-100 text-amber-700 border border-amber-200') }}">
                                            {{ strtoupper(substr($booking->customer_name, 0, 2)) }}
                                        </div>
                                        <div class="min-w-0">
                                            {{-- Booking code --}}
                                            <span class="inline-block text-[8px] font-black tracking-wider text-emerald-700 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded mb-1 font-mono">
                                                {{ $booking->booking_code }}
                                            </span>
                                            <p class="text-slate-900 font-bold text-sm truncate leading-tight">
                                                {{ $booking->customer_name }}
                                            </p>
                                            <div class="flex flex-col gap-0.5 mt-1">
                                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_phone) }}"
                                                   target="_blank"
                                                   class="text-[11px] text-slate-400 hover:text-emerald-600 transition-colors font-medium flex items-center gap-1 leading-none">
                                                    <svg class="w-2.5 h-2.5 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                    {{ $booking->customer_phone }}
                                                </a>
                                                <span class="text-[11px] text-slate-300 truncate leading-none">{{ $booking->customer_email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Package --}}
                                <td class="py-4 px-5">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-base">{{ $booking->campingPackage->slug === 'river-camp' ? '🏞' : '🏕️' }}</span>
                                        <p class="text-slate-800 font-bold text-sm">
                                            {{ $booking->campingPackage->name ?? '–' }} @if(($booking->quantity ?? 1) > 1) ({{ $booking->quantity }}x) @endif
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1.5 ml-7">
                                        <svg class="w-3 h-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span class="text-[11px] text-slate-400 font-semibold">{{ $booking->total_guests }} orang</span>
                                    </div>
                                </td>

                                {{-- Duration --}}
                                <td class="py-4 px-5">
                                    @php
                                        $checkIn  = \Carbon\Carbon::parse($booking->check_in_date);
                                        $checkOut = \Carbon\Carbon::parse($booking->check_out_date);
                                        $nights   = $checkIn->diffInDays($checkOut);
                                    @endphp
                                    <div class="space-y-1.5">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-12 text-[8px] font-black text-emerald-600 bg-emerald-50 border border-emerald-100 px-1.5 py-0.5 rounded text-center uppercase tracking-wide">Masuk</span>
                                            <span class="text-slate-700 font-semibold text-xs">
                                                {{ $checkIn->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="inline-block w-12 text-[8px] font-black text-rose-600 bg-rose-50 border border-rose-100 px-1.5 py-0.5 rounded text-center uppercase tracking-wide">Keluar</span>
                                            <span class="text-slate-700 font-semibold text-xs">
                                                {{ $checkOut->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                        <div class="ml-14">
                                            <span class="text-[10px] text-slate-400 font-semibold">{{ $nights }} malam</span>
                                        </div>
                                    </div>
                                </td>

                                {{-- Price --}}
                                <td class="py-4 px-5">
                                    <p class="text-slate-900 font-black text-sm">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </p>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">
                                        @if(($booking->quantity ?? 1) > 1)
                                            {{ $nights }} malam × {{ $booking->quantity }} × Rp {{ number_format($booking->campingPackage->price ?? 0, 0, ',', '.') }}
                                        @else
                                            {{ $nights }} × Rp {{ number_format($booking->campingPackage->price ?? 0, 0, ',', '.') }}
                                        @endif
                                    </p>
                                </td>

                                {{-- Status Badge --}}
                                <td class="py-4 px-5 text-center">
                                    @if($booking->status === 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-700 border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Menunggu
                                        </span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest bg-slate-100 text-slate-500 border border-slate-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            Dibatalkan
                                        </span>
                                    @endif

                                    {{-- Booked at --}}
                                    <p class="text-[9px] text-slate-300 mt-1.5 font-medium">
                                        {{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}
                                    </p>
                                </td>

                                {{-- Action Buttons --}}
                                <td class="py-4 px-5">
                                    <div class="flex items-center justify-center gap-1.5">
                                        @if($booking->status === 'pending')
                                            {{-- Approve --}}
                                            <button
                                                type="button"
                                                onclick="openModal('approve', '{{ addslashes($booking->customer_name) }}', '{{ route('admin.updateStatus', $booking->id) }}')"
                                                data-tooltip="Setujui"
                                                class="relative w-8 h-8 rounded-xl bg-white hover:bg-emerald-600 text-slate-600 hover:text-white border border-slate-200 hover:border-emerald-600 shadow-sm hover:shadow-emerald-500/30 hover:shadow-md transition-all duration-200 flex items-center justify-center text-base group/btn">
                                                ✅
                                            </button>

                                            {{-- Reject --}}
                                            <button
                                                type="button"
                                                onclick="openModal('reject', '{{ addslashes($booking->customer_name) }}', '{{ route('admin.updateStatus', $booking->id) }}')"
                                                data-tooltip="Tolak"
                                                class="relative w-8 h-8 rounded-xl bg-white hover:bg-rose-600 text-slate-600 hover:text-white border border-slate-200 hover:border-rose-600 shadow-sm hover:shadow-rose-500/30 hover:shadow-md transition-all duration-200 flex items-center justify-center text-base">
                                                ❌
                                            </button>

                                            {{-- WhatsApp quick contact --}}
                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_phone) }}?text=Halo%20{{ urlencode($booking->customer_name) }}%2C%20kami%20dari%20Gedoy%20Camping%20Park%20ingin%20mengkonfirmasi%20reservasi%20Anda%20dengan%20kode%20{{ $booking->booking_code }}."
                                               target="_blank"
                                               data-tooltip="WhatsApp"
                                               class="relative w-8 h-8 rounded-xl bg-white hover:bg-green-500 text-slate-600 hover:text-white border border-slate-200 hover:border-green-500 shadow-sm hover:shadow-green-500/30 hover:shadow-md transition-all duration-200 flex items-center justify-center text-sm">
                                                💬
                                            </a>

                                        @else
                                            {{-- Revert to pending (undo) --}}
                                            @if($booking->status === 'confirmed')
                                                <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit"
                                                            data-tooltip="Kembalikan ke Pending"
                                                            onclick="return confirm('Kembalikan pesanan ini ke status Menunggu?')"
                                                            class="w-8 h-8 rounded-xl bg-white hover:bg-amber-100 text-slate-400 hover:text-amber-700 border border-slate-200 hover:border-amber-200 shadow-sm transition-all duration-200 flex items-center justify-center text-sm">
                                                        ↩️
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- WhatsApp --}}
                                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_phone) }}"
                                               target="_blank"
                                               data-tooltip="WhatsApp"
                                               class="w-8 h-8 rounded-xl bg-white hover:bg-green-500 text-slate-500 hover:text-white border border-slate-200 hover:border-green-500 shadow-sm transition-all duration-200 flex items-center justify-center text-sm">
                                                💬
                                            </a>

                                            {{-- Delete --}}
                                            <button
                                                type="button"
                                                onclick="openModal('delete', '{{ addslashes($booking->customer_name) }}', '{{ route('admin.destroy', $booking->id) }}')"
                                                data-tooltip="Hapus Permanen"
                                                class="w-8 h-8 rounded-xl bg-white hover:bg-red-600 text-slate-400 hover:text-white border border-slate-200 hover:border-red-500 shadow-sm hover:shadow-red-500/30 hover:shadow-md transition-all duration-200 flex items-center justify-center text-sm">
                                                🗑️
                                            </button>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                            @empty
                            {{-- Empty State --}}
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-3xl mb-4">📭</div>
                                        <p class="text-slate-500 font-bold text-base mb-1">Belum Ada Reservasi</p>
                                        <p class="text-slate-300 text-sm max-w-xs mx-auto">Semua pesanan dari formulir reservasi akan muncul di sini secara otomatis.</p>
                                        <a href="{{ route('home') }}" class="mt-5 text-xs font-bold text-emerald-600 hover:text-emerald-700 underline underline-offset-2 transition-colors">
                                            Lihat halaman publik →
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Table Footer: Summary --}}
                @if($bookings->count() > 0)
                <div class="px-5 py-3.5 border-t border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-3">
                    <p class="text-xs text-slate-400 font-medium">
                        Menampilkan <span id="visible-count" class="font-bold text-slate-600">{{ $bookings->count() }}</span>
                        dari {{ $bookings->count() }} data reservasi
                    </p>
                    <div class="flex items-center gap-4 text-xs">
                        <span class="flex items-center gap-1.5 text-amber-600 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                            {{ $bookings->where('status','pending')->count() }} Pending
                        </span>
                        <span class="flex items-center gap-1.5 text-emerald-600 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            {{ $bookings->where('status','confirmed')->count() }} Confirmed
                        </span>
                        <span class="flex items-center gap-1.5 text-slate-400 font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                            {{ $bookings->where('status','cancelled')->count() }} Cancelled
                        </span>
                    </div>
                </div>
                @endif

            </div>


            {{-- ─ MINI ANALYTICS ROW ──────────────────────────────── --}}
            <div class="fade-up-delay-3 grid grid-cols-1 md:grid-cols-2 gap-5 pb-2">

                {{-- Package breakdown --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">
                        Distribusi per Paket
                    </h3>
                    @php
                        $riverCount = $bookings->filter(fn($b) => $b->campingPackage && $b->campingPackage->slug === 'river-camp')->count();
                        $pinusCount = $bookings->filter(fn($b) => $b->campingPackage && $b->campingPackage->slug === 'pinus-camp')->count();
                        $total      = max(1, $bookings->count());
                    @endphp
                    <div class="space-y-4">
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-sm font-bold text-slate-700 flex items-center gap-1.5">🏞 River Camp</span>
                                <span class="text-sm font-black text-slate-900">{{ $riverCount }} <span class="text-slate-400 font-medium text-xs">pesanan</span></span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-blue-400 to-blue-500 rounded-full transition-all duration-700"
                                     style="width: {{ $total > 0 ? round(($riverCount / $total) * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $total > 0 ? round(($riverCount / $total) * 100) : 0 }}% dari total</p>
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-sm font-bold text-slate-700 flex items-center gap-1.5">🏕️ Sewa Tempat</span>
                                <span class="text-sm font-black text-slate-900">{{ $pinusCount }} <span class="text-slate-400 font-medium text-xs">pesanan</span></span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-500 rounded-full transition-all duration-700"
                                     style="width: {{ $total > 0 ? round(($pinusCount / $total) * 100) : 0 }}%"></div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1">{{ $total > 0 ? round(($pinusCount / $total) * 100) : 0 }}% dari total</p>
                        </div>
                    </div>
                </div>

                {{-- Quick actions & info --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">
                        Aksi Cepat
                    </h3>
                    <div class="space-y-2.5">
                        <a href="{{ route('home') }}" target="_blank"
                           class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50 transition-all duration-200 group">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-sm flex-shrink-0 group-hover:bg-emerald-200 transition-colors">🌐</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 leading-tight">Lihat Website Publik</p>
                                <p class="text-[11px] text-slate-400">Buka halaman utama di tab baru</p>
                            </div>
                            <svg class="w-3.5 h-3.5 text-slate-300 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                        <a href="https://wa.me/6281222099317" target="_blank"
                           class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-green-200 hover:bg-green-50 transition-all duration-200 group">
                            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center text-sm flex-shrink-0 group-hover:bg-green-200 transition-colors">💬</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 leading-tight">Hubungi via WhatsApp</p>
                                <p class="text-[11px] text-slate-400">+62 812-2209-9317</p>
                            </div>
                        </a>
                        <button onclick="window.print()"
                                class="w-full flex items-center gap-3 p-3 rounded-xl border border-slate-100 hover:border-slate-200 hover:bg-slate-50 transition-all duration-200 group text-left">
                            <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-sm flex-shrink-0 group-hover:bg-slate-200 transition-colors">🖨️</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 leading-tight">Cetak / Export Laporan</p>
                                <p class="text-[11px] text-slate-400">Print atau simpan sebagai PDF</p>
                            </div>
                        </button>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>


{{-- ================================================================
     INLINE SCRIPTS
================================================================ --}}
<script>
(function () {

    // ── Live Clock ──────────────────────────────────────────────
    const clockEl = document.getElementById('live-clock');
    function updateClock() {
        if (!clockEl) return;
        const now  = new Date();
        const hh   = String(now.getHours()).padStart(2,'0');
        const mm   = String(now.getMinutes()).padStart(2,'0');
        const ss   = String(now.getSeconds()).padStart(2,'0');
        clockEl.textContent = `${hh}:${mm}:${ss}`;
    }
    updateClock();
    setInterval(updateClock, 1000);

    // ── Mobile Sidebar ──────────────────────────────────────────
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

    // ── Table Filter by Status ──────────────────────────────────
    let activeStatus = 'all';
    let activeSearch = '';

    window.filterTable = function (status) {
        activeStatus = status;

        // Update button UI
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('bg-white', 'shadow-sm', 'text-slate-700');
            btn.classList.add('text-slate-500');
        });
        const activeBtn = document.getElementById('filter-' + status);
        if (activeBtn) {
            activeBtn.classList.add('bg-white', 'shadow-sm', 'text-slate-700');
            activeBtn.classList.remove('text-slate-500');
        }

        applyFilters();
    };

    function applyFilters() {
        const rows = document.querySelectorAll('.table-row');
        let visible = 0;

        rows.forEach(row => {
            const matchStatus = activeStatus === 'all' || row.dataset.status === activeStatus;
            const matchSearch = activeSearch === '' || (row.dataset.search && row.dataset.search.includes(activeSearch));
            if (matchStatus && matchSearch) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('visible-count');
        if (countEl) countEl.textContent = visible;
    }

    // ── Live Search ─────────────────────────────────────────────
    const searchInput = document.getElementById('table-search');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            activeSearch = this.value.toLowerCase().trim();
            applyFilters();
        });
    }

    // ── Keyboard shortcuts ──────────────────────────────────────
    document.addEventListener('keydown', function (e) {
        // Escape closes modals
        if (e.key === 'Escape') {
            ['modal-approve','modal-reject','modal-delete'].forEach(id => {
                if (!document.getElementById(id).classList.contains('hidden')) {
                    closeModal(id);
                }
            });
            closeMobileSidebar();
        }
    });

})();
</script>

</body>
</html>