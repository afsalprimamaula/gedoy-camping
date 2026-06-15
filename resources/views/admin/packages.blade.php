<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Manajemen Paket – Gedoy Camping Park</title>

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
        @keyframes softPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.7; transform: scale(0.96); }
        }
        .pulse-soft { animation: softPulse 2s ease-in-out infinite; }
        .modal-backdrop { background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); }
        .pkg-card:hover { transform: translateY(-2px); box-shadow: 0 20px 60px rgba(0,0,0,0.12); }
        .pkg-card { transition: all 0.25s ease; }
        .img-placeholder {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 40%, #047857 100%);
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

{{-- ================================================================
     MODAL: Tambah / Edit Paket
================================================================ --}}
<div id="modal-package" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full p-8 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 flex items-center justify-center text-2xl">⛺</div>
                <div>
                    <h3 id="modal-pkg-title" class="text-xl font-black text-slate-900">Tambah Paket Baru</h3>
                    <p class="text-slate-400 text-xs">Isi semua data paket wisata camping</p>
                </div>
            </div>
            <button onclick="closePackageModal()" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="pkg-form" method="POST" action="{{ route('admin.packages.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="pkg-method" name="_method" value="POST">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Nama Paket <span class="text-rose-500">*</span></label>
                    <input type="text" name="name" id="pkg-name" required placeholder="cth: Paket Camping 4 Orang"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Harga (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" name="price" id="pkg-price" required min="0" placeholder="350000"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Kapasitas (Orang) <span class="text-rose-500">*</span></label>
                    <input type="number" name="capacity" id="pkg-capacity" required min="1" placeholder="4"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Deskripsi <span class="text-rose-500">*</span></label>
                    <textarea name="description" id="pkg-description" rows="3" required
                              placeholder="Deskripsi singkat paket camping..."
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all resize-none"></textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Fasilitas</label>
                    <p class="text-slate-400 text-[11px] mb-2">Pisahkan tiap fasilitas dengan koma. cth: Tenda, Sleeping Bag, Matras</p>
                    <input type="text" name="features_raw" id="pkg-features" placeholder="Papan dex, Alas tenda, Sleeping bag, Matras, Lampu tenda"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Foto Paket</label>
                    <p class="text-slate-400 text-[11px] mb-2">Format: JPG, PNG, WEBP. Maks. 5MB. Kosongkan jika menggunakan gambar default.</p>
                    <div class="flex items-center gap-4">
                        <div id="pkg-img-preview-container" class="hidden w-16 h-16 rounded-xl overflow-hidden bg-slate-100 border flex-shrink-0">
                            <img id="pkg-img-preview" src="" class="w-full h-full object-cover">
                        </div>
                        <input type="file" name="image" id="pkg-image" accept="image/*" onchange="previewPkgImage(this)"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all bg-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Status</label>
                    <select name="is_active" id="pkg-status"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all bg-white">
                        <option value="1">✅ Aktif (Tampil di Website)</option>
                        <option value="0">🔒 Nonaktif (Disembunyikan)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5 uppercase tracking-wider">Emoji Icon</label>
                    <input type="text" name="icon" id="pkg-icon" placeholder="⛺"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 outline-none text-sm font-medium transition-all">
                </div>
            </div>

            <div class="flex gap-3 mt-8">
                <button type="button" onclick="closePackageModal()"
                        class="flex-1 py-3.5 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm transition shadow-lg shadow-emerald-600/30">
                    💾 Simpan Paket
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirm Modal --}}
<div id="modal-pkg-delete" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl mx-auto mb-5">🗑️</div>
        <h3 class="text-xl font-black text-slate-900 mb-2">Hapus Paket?</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan menghapus paket:</p>
        <p id="del-pkg-name" class="text-slate-900 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <div class="bg-red-50 border border-red-100 rounded-xl p-3 mb-6">
            <p class="text-red-600 text-xs font-semibold">⚠️ Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="flex gap-3">
            <button onclick="document.getElementById('modal-pkg-delete').classList.add('hidden')"
                    class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="del-pkg-form" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit"
                        class="w-full py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition shadow-lg shadow-red-600/30">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

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
               class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">⛺</span>
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
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Manajemen Paket</span>
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
        <main class="flex-1 overflow-y-auto custom-scroll bg-slate-50 px-4 md:px-6 lg:px-8 py-6 space-y-6">

            {{-- Flash Alert --}}
            @if(session('success'))
                <div id="pkg-alert" class="fade-up flex items-center gap-4 bg-white border border-emerald-200 rounded-2xl shadow-sm px-5 py-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-base flex-shrink-0">✨</div>
                    <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                    <button onclick="document.getElementById('pkg-alert').remove()" class="flex-shrink-0 text-slate-300 hover:text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            {{-- Page Title --}}
            <div class="fade-up flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                        Manajemen Paket
                        <span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">Wisata</span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-1 font-medium">Kelola paket camping yang ditampilkan di website publik Gedoy Camping Park</p>
                </div>
                <button onclick="openPackageModal()"
                        class="flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm transition-all duration-200 shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/40 hover:-translate-y-0.5 flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Paket Baru
                </button>
            </div>

            {{-- Stats bar --}}
            <div class="fade-up-delay-1 grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Total Paket</p>
                    <p class="text-2xl font-black text-slate-900">{{ $packages->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Paket Aktif</p>
                    <p class="text-2xl font-black text-emerald-600">{{ $packages->where('is_active', true)->count() }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Harga Terendah</p>
                    <p class="text-lg font-black text-slate-900">Rp {{ number_format($packages->min('price'), 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Harga Tertinggi</p>
                    <p class="text-lg font-black text-slate-900">Rp {{ number_format($packages->max('price'), 0, ',', '.') }}</p>
                </div>
            </div>

            {{-- Package Grid --}}
            <div class="fade-up-delay-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($packages as $pkg)
                    <div class="pkg-card bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden animate-fade-in">
                        {{-- Image / Placeholder --}}
                        <div class="relative h-48 flex items-center justify-center overflow-hidden bg-slate-900">
                            @if($pkg->image_path)
                                <img src="{{ asset('storage/' . $pkg->image_path) }}" class="absolute inset-0 w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40"></div>
                            @else
                                <div class="absolute inset-0 img-placeholder"></div>
                                <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.4\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>')"></div>
                            @endif
                            <div class="relative text-center z-10">
                                <div class="text-6xl mb-2">{{ $pkg->icon ?? '⛺' }}</div>
                                <span class="text-white/70 text-xs font-semibold uppercase tracking-wider">Gedoy Camping Park</span>
                            </div>
                            {{-- Status badge --}}
                            <div class="absolute top-3 right-3 z-10">
                                @if($pkg->is_active ?? true)
                                    <span class="bg-emerald-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">Aktif</span>
                                @else
                                    <span class="bg-slate-500 text-white text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shadow">Nonaktif</span>
                                @endif
                            </div>
                        </div>

                        {{-- Card Body --}}
                        <div class="p-5">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-black text-slate-900 text-base leading-tight">{{ $pkg->name }}</h3>
                                <span class="flex-shrink-0 ml-2 text-xs font-bold text-slate-400 bg-slate-50 border border-slate-100 px-2 py-1 rounded-lg">
                                    👤 {{ $pkg->capacity }} Orang
                                </span>
                            </div>

                            <p class="text-slate-500 text-xs leading-relaxed mb-3 line-clamp-2">{{ $pkg->description }}</p>

                            {{-- Price --}}
                            <div class="mb-4">
                                <p class="text-emerald-700 font-black text-xl">Rp {{ number_format($pkg->price, 0, ',', '.') }}</p>
                                <p class="text-slate-400 text-[10px] font-medium">per malam / paket</p>
                            </div>

                            {{-- Features --}}
                            @if($pkg->features && count($pkg->features) > 0)
                                <div class="flex flex-wrap gap-1.5 mb-4">
                                    @foreach(array_slice($pkg->features, 0, 5) as $feat)
                                        <span class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                            {{ $feat }}
                                        </span>
                                    @endforeach
                                    @if(count($pkg->features) > 5)
                                        <span class="bg-slate-50 border border-slate-200 text-slate-500 text-[10px] font-bold px-2.5 py-1 rounded-full">
                                            +{{ count($pkg->features) - 5 }} lainnya
                                        </span>
                                    @endif
                                </div>
                            @endif

                            {{-- Actions --}}
                            <div class="flex gap-2 pt-4 border-t border-slate-100">
                                <button onclick="editPackage({{ $pkg->id }}, '{{ addslashes($pkg->name) }}', {{ $pkg->price }}, {{ $pkg->capacity }}, '{{ addslashes($pkg->description) }}', '{{ implode(', ', $pkg->features ?? []) }}', '{{ $pkg->image_path ? asset('storage/' . $pkg->image_path) : '' }}', '{{ $pkg->icon }}', '{{ $pkg->is_active }}')"
                                        class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl bg-slate-50 hover:bg-emerald-50 border border-slate-200 hover:border-emerald-300 text-slate-600 hover:text-emerald-700 text-xs font-bold transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </button>
                                <a href="{{ route('booking.show', $pkg->slug) }}" target="_blank"
                                   class="flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 border border-slate-200 hover:border-blue-300 text-slate-600 hover:text-blue-700 text-xs font-bold transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <button onclick="confirmDeletePkg({{ $pkg->id }}, '{{ addslashes($pkg->name) }}')"
                                        class="flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-50 hover:bg-red-50 border border-slate-200 hover:border-red-300 text-slate-600 hover:text-red-600 text-xs font-bold transition-all duration-200">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="sm:col-span-2 lg:col-span-3 bg-white rounded-3xl border border-dashed border-slate-200 p-16 text-center">
                        <div class="text-6xl mb-4">⛺</div>
                        <h3 class="text-lg font-black text-slate-700 mb-2">Belum ada paket wisata</h3>
                        <p class="text-slate-400 text-sm mb-6">Mulai tambahkan paket camping untuk ditampilkan di website publik.</p>
                        <button onclick="openPackageModal()"
                                class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-sm transition-all shadow-lg shadow-emerald-600/30">
                            + Tambah Paket Pertama
                        </button>
                    </div>
                @endforelse
            </div>

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
})();

// Package modal
function openPackageModal(mode = 'create') {
    document.getElementById('modal-pkg-title').textContent = mode === 'create' ? 'Tambah Paket Baru' : 'Edit Paket';
    document.getElementById('modal-package').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closePackageModal() {
    document.getElementById('modal-package').classList.add('hidden');
    document.body.style.overflow = '';
    document.getElementById('pkg-form').reset();
    document.getElementById('pkg-method').value = 'POST';
    document.getElementById('pkg-form').action = '{{ route("admin.packages.store") }}';
    document.getElementById('modal-pkg-title').textContent = 'Tambah Paket Baru';
    document.getElementById('pkg-img-preview-container').classList.add('hidden');
    document.getElementById('pkg-img-preview').src = '';
}
function editPackage(id, name, price, capacity, desc, features, imageUrl, icon, isActive) {
    document.getElementById('modal-pkg-title').textContent = 'Edit Paket';
    document.getElementById('pkg-name').value = name;
    document.getElementById('pkg-price').value = price;
    document.getElementById('pkg-capacity').value = capacity;
    document.getElementById('pkg-description').value = desc;
    document.getElementById('pkg-features').value = features;
    document.getElementById('pkg-icon').value = icon || '⛺';
    document.getElementById('pkg-status').value = isActive !== undefined ? isActive : '1';

    const previewContainer = document.getElementById('pkg-img-preview-container');
    const previewImg = document.getElementById('pkg-img-preview');
    if (imageUrl) {
        previewImg.src = imageUrl;
        previewContainer.classList.remove('hidden');
    } else {
        previewImg.src = '';
        previewContainer.classList.add('hidden');
    }

    document.getElementById('pkg-method').value = 'PUT';
    document.getElementById('pkg-form').action = `/admin/packages/${id}`;
    document.getElementById('modal-package').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function previewPkgImage(input) {
    const previewContainer = document.getElementById('pkg-img-preview-container');
    const previewImg = document.getElementById('pkg-img-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewContainer.classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function confirmDeletePkg(id, name) {
    document.getElementById('del-pkg-name').textContent = name;
    document.getElementById('del-pkg-form').action = `/admin/packages/${id}`;
    document.getElementById('modal-pkg-delete').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Close modals on backdrop
['modal-package', 'modal-pkg-delete'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
});

// ESC closes
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closePackageModal();
        document.getElementById('modal-pkg-delete').classList.add('hidden');
        document.body.style.overflow = '';
        closeMobileSidebar();
    }
});
</script>
</body>
</html>
