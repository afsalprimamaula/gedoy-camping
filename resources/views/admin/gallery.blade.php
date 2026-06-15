<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Galeri & Konten – Gedoy Camping Park</title>
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
        .modal-backdrop { background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); }

        /* Drop Zone */
        .drop-zone {
            border: 2px dashed #d1d5db;
            transition: all 0.25s ease;
        }
        .drop-zone.drag-over {
            border-color: #059669;
            background-color: #f0fdf4;
            transform: scale(1.01);
        }
        .drop-zone:hover {
            border-color: #6ee7b7;
            background-color: #f9fafb;
        }

        /* Gallery Grid */
        .gallery-grid {
            columns: 2;
            column-gap: 1rem;
        }
        @media (min-width: 640px) { .gallery-grid { columns: 3; } }
        @media (min-width: 1024px) { .gallery-grid { columns: 4; } }

        .gallery-item {
            break-inside: avoid;
            margin-bottom: 1rem;
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%;
            display: block;
            transition: transform 0.4s ease;
        }
        .gallery-item:hover img { transform: scale(1.05); }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 12px;
        }
        .gallery-item:hover .gallery-overlay { opacity: 1; }

        /* Upload progress */
        .upload-progress-bar {
            transition: width 0.3s ease;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .skeleton {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 16px;
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

{{-- Delete Confirm Modal --}}
<div id="modal-img-delete" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center text-3xl mx-auto mb-5">🗑️</div>
        <h3 class="text-xl font-black text-slate-900 mb-2">Hapus Foto?</h3>
        <p class="text-slate-500 text-sm mb-6">Foto ini akan dihapus permanen dari galeri website.</p>
        <div id="modal-img-preview" class="mb-6 rounded-2xl overflow-hidden max-h-40 bg-slate-100 flex items-center justify-center"></div>
        <div class="flex gap-3">
            <button onclick="document.getElementById('modal-img-delete').classList.add('hidden'); document.body.style.overflow='';"
                    class="flex-1 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">
                Batal
            </button>
            <form id="del-img-form" method="POST" class="flex-1">
                @csrf @method('DELETE')
                <button type="submit" class="w-full py-3 rounded-2xl bg-red-600 hover:bg-red-700 text-white font-bold text-sm transition shadow-lg shadow-red-600/30">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="hidden fixed inset-0 z-[300] flex items-center justify-center" style="background:rgba(0,0,0,0.92);" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-colors z-10">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="lightbox-img" src="" alt="" class="max-w-[90vw] max-h-[90vh] object-contain rounded-2xl shadow-2xl" onclick="event.stopPropagation()">
</div>

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
            <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8 transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">👥</span>Data Pelanggan
            </a>
            <a href="{{ route('admin.gallery.index') }}" class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">🖼️</span>Galeri & Konten
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
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Galeri & Konten</span>
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

            {{-- Flash --}}
            @if(session('success'))
                <div id="gallery-alert" class="fade-up flex items-center gap-4 bg-white border border-emerald-200 rounded-2xl shadow-sm px-5 py-3.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 flex items-center justify-center text-base flex-shrink-0">✨</div>
                    <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                    <button onclick="document.getElementById('gallery-alert').remove()" class="text-slate-300 hover:text-slate-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="fade-up flex items-center gap-4 bg-white border border-rose-200 rounded-2xl shadow-sm px-5 py-3.5">
                    <div class="w-9 h-9 rounded-xl bg-rose-100 flex items-center justify-center text-base flex-shrink-0">❌</div>
                    <p class="flex-1 text-sm font-semibold text-rose-800">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Title --}}
            <div class="fade-up flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl md:text-2xl font-black text-slate-900 tracking-tight leading-tight">
                        Galeri
                        <span class="text-transparent bg-clip-text" style="background: linear-gradient(135deg, #059669, #10b981); -webkit-background-clip: text;">Konten Website</span>
                    </h1>
                    <p class="text-slate-400 text-xs mt-1 font-medium">Kelola foto & konten visual untuk halaman landing page Gedoy Camping Park</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-2 rounded-xl">
                        📸 {{ $images->count() }} Foto
                    </span>
                </div>
            </div>

            {{-- Upload Zone --}}
            <div class="fade-up-delay-1 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h2 class="text-base font-black text-slate-900">Upload Foto Baru</h2>
                    <p class="text-slate-400 text-xs mt-0.5">Format yang didukung: JPG, PNG, WEBP. Maks. 5MB per file.</p>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                        @csrf
                        {{-- Drop Zone --}}
                        <div id="drop-zone"
                             class="drop-zone rounded-2xl p-10 text-center cursor-pointer relative"
                             onclick="document.getElementById('file-input').click()"
                             ondragover="handleDragOver(event)"
                             ondragleave="handleDragLeave(event)"
                             ondrop="handleDrop(event)">
                            <input type="file" id="file-input" name="images[]" multiple accept="image/*" class="hidden" onchange="handleFileSelect(event)">

                            <div id="drop-idle">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-50 border-2 border-emerald-200 flex items-center justify-center text-3xl mx-auto mb-4">🖼️</div>
                                <p class="text-base font-black text-slate-700 mb-1">Drag & drop foto di sini</p>
                                <p class="text-slate-400 text-sm mb-4">atau klik untuk memilih file dari komputer</p>
                                <button type="button" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition-all shadow-lg shadow-emerald-600/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    Pilih Foto
                                </button>
                            </div>

                            {{-- Preview area --}}
                            <div id="file-previews" class="hidden">
                                <div id="preview-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4"></div>
                                <div class="flex items-center justify-center gap-3">
                                    <button type="submit" id="upload-btn"
                                            class="flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm transition-all shadow-lg shadow-emerald-600/30">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        Upload Sekarang
                                    </button>
                                    <button type="button" onclick="clearPreviews()"
                                            class="px-4 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition-all">
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Upload progress --}}
                        <div id="upload-progress" class="hidden mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-slate-600">Mengupload...</span>
                                <span id="upload-percent" class="text-xs font-bold text-emerald-700">0%</span>
                            </div>
                            <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                                <div id="upload-bar" class="h-full bg-emerald-500 rounded-full upload-progress-bar" style="width:0%"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Gallery Grid --}}
            <div class="fade-up-delay-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-base font-black text-slate-900">Koleksi Foto Galeri</h2>
                        <p class="text-slate-400 text-xs mt-0.5">Hover pada foto untuk melihat opsi aksi</p>
                    </div>
                    @if($images->count() > 0)
                        <span class="text-xs text-slate-400 font-medium">{{ $images->count() }} foto</span>
                    @endif
                </div>

                <div class="p-6">
                    @if($images->count() > 0)
                        <div class="gallery-grid">
                            @foreach($images as $image)
                                <div class="gallery-item shadow-sm hover:shadow-xl transition-shadow duration-300">
                                    <img src="{{ Storage::url($image->path) }}"
                                         alt="{{ $image->original_name ?? 'Foto Galeri' }}"
                                         loading="lazy"
                                         class="w-full"
                                         onclick="openLightbox('{{ Storage::url($image->path) }}')">
                                    <div class="gallery-overlay">
                                        <div class="flex items-center justify-between w-full">
                                            <span class="text-white text-[10px] font-semibold truncate max-w-[70%]">{{ $image->original_name ?? 'foto-' . $image->id }}</span>
                                            <button onclick="event.stopPropagation(); confirmDeleteImg({{ $image->id }}, '{{ Storage::url($image->path) }}')"
                                                    class="flex-shrink-0 w-8 h-8 rounded-lg bg-red-500 hover:bg-red-600 flex items-center justify-center text-white text-sm transition-colors shadow-lg">
                                                🗑️
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-20 text-center">
                            <div class="text-6xl mb-4">📷</div>
                            <h3 class="text-lg font-black text-slate-700 mb-2">Galeri masih kosong</h3>
                            <p class="text-slate-400 text-sm mb-6">Upload foto pertama Anda untuk ditampilkan di website Gedoy Camping Park.</p>
                        </div>
                    @endif
                </div>
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
        clockEl.textContent = [new Date().getHours(), new Date().getMinutes(), new Date().getSeconds()].map(v=>String(v).padStart(2,'0')).join(':');
    }
    updateClock(); setInterval(updateClock, 1000);

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
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') { closeMobileSidebar(); closeLightbox(); document.getElementById('modal-img-delete').classList.add('hidden'); document.body.style.overflow=''; }
    });
})();

// Drag & Drop
function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('drop-zone').classList.add('drag-over');
}
function handleDragLeave(e) {
    e.preventDefault();
    document.getElementById('drop-zone').classList.remove('drag-over');
}
function handleDrop(e) {
    e.preventDefault();
    e.stopPropagation();
    document.getElementById('drop-zone').classList.remove('drag-over');
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('file-input').files = files;
        showPreviews(files);
    }
}
function handleFileSelect(e) {
    showPreviews(e.target.files);
}
function showPreviews(files) {
    if (!files || files.length === 0) return;
    const grid = document.getElementById('preview-grid');
    grid.innerHTML = '';
    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            const div = document.createElement('div');
            div.className = 'relative rounded-xl overflow-hidden aspect-square bg-slate-100';
            div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">
                             <div class="absolute bottom-1 left-1 right-1">
                               <p class="text-[9px] text-white font-bold bg-black/50 rounded px-1.5 py-0.5 truncate">${file.name}</p>
                             </div>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
    document.getElementById('drop-idle').classList.add('hidden');
    document.getElementById('file-previews').classList.remove('hidden');
}
function clearPreviews() {
    document.getElementById('file-input').value = '';
    document.getElementById('preview-grid').innerHTML = '';
    document.getElementById('file-previews').classList.add('hidden');
    document.getElementById('drop-idle').classList.remove('hidden');
}

// Lightbox
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.body.style.overflow = '';
}

// Delete image modal
function confirmDeleteImg(id, imgSrc) {
    const preview = document.getElementById('modal-img-preview');
    preview.innerHTML = `<img src="${imgSrc}" class="w-full h-40 object-cover">`;
    document.getElementById('del-img-form').action = `/admin/gallery/${id}`;
    document.getElementById('modal-img-delete').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Upload progress simulation
document.getElementById('upload-form').addEventListener('submit', function(e) {
    const fileInput = document.getElementById('file-input');
    if (fileInput.files.length === 0) { e.preventDefault(); return; }
    document.getElementById('upload-progress').classList.remove('hidden');
    document.getElementById('upload-btn').disabled = true;
    document.getElementById('upload-btn').textContent = 'Mengupload...';
    // Simulate progress
    let pct = 0;
    const interval = setInterval(() => {
        pct = Math.min(pct + Math.random() * 20, 90);
        document.getElementById('upload-bar').style.width = pct + '%';
        document.getElementById('upload-percent').textContent = Math.round(pct) + '%';
    }, 200);
    setTimeout(() => clearInterval(interval), 2000);
});
</script>
</body>
</html>
