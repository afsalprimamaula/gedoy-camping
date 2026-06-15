<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Manajemen Menu Restoran – Gedoy Camping Park</title>

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
               class="nav-active flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                <span class="w-7 h-7 rounded-lg bg-amber-500/20 flex items-center justify-center text-sm flex-shrink-0">🍳</span>
                Restoran Gedoy
            </a>

            <a href="{{ route('admin.restaurant_orders.index') }}"
               class="{{ Request::routeIs('admin.restaurant_orders.*') ? 'nav-active' : 'text-emerald-300/70 hover:text-white hover:bg-white/5 border border-transparent hover:border-white/8' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group">
                <span class="w-7 h-7 rounded-lg bg-white/5 group-hover:bg-white/10 flex items-center justify-center text-sm flex-shrink-0 transition-colors">📋</span>
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
                    <span class="text-slate-700 font-bold bg-slate-100 px-3 py-1 rounded-lg">Manajemen Menu Restoran</span>
                </div>
            </div>
            <div class="flex items-center gap-2 sm:gap-3">
                <div class="hidden sm:flex items-center gap-1.5 bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-lg">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></span>
                    <span class="text-emerald-700 text-[10px] font-bold uppercase tracking-wider">Live · PostgreSQL</span>
                </div>
                <div class="hidden md:block text-xs text-slate-400 font-medium"><span id="live-clock"></span></div>
                <div class="h-5 w-px bg-slate-200 hidden sm:block"></div>
                <a href="{{ route('restaurant.index') }}" target="_blank" class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-slate-600 hover:text-emerald-700 bg-slate-100 hover:bg-slate-200 px-3 py-1.5 rounded-lg transition-colors">🍴 Restoran Publik</a>
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
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl text-emerald-950 font-bold leading-tight">Manajemen Menu Restoran</h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Tambah, perbarui, dan kelola ketersediaan hidangan di Restoran Gedoy.</p>
                </div>
                <button onclick="openAddModal()"
                        class="inline-flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-950 text-white font-bold text-sm px-5 py-3 rounded-xl shadow transition duration-200 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                    <span>➕</span> Tambah Menu Baru
                </button>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden mb-12">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200/80 text-xs font-bold text-slate-400 uppercase tracking-wider">
                                <th class="py-4 px-6">Foto Menu</th>
                                <th class="py-4 px-6">Nama Item</th>
                                <th class="py-4 px-6">Kategori</th>
                                <th class="py-4 px-6">Harga (IDR)</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($menus as $menu)
                                @php
                                    // Map local menu seed name to gorgeous Unsplash photos (identical to index page)
                                    $imageMap = [
                                        'Nasi Goreng Kampung Premium' => 'https://images.unsplash.com/photo-1616645300522-83b6329ff07d?q=80&w=200&auto=format&fit=crop',
                                        'Sate Maranggi Ciater' => 'https://images.unsplash.com/photo-1529193591184-b1d58069ecdd?q=80&w=200&auto=format&fit=crop',
                                        'Iga Bakar Madu Hutan' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=200&auto=format&fit=crop',
                                        'Pisang Bakar Keju Caramel' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=200&auto=format&fit=crop',
                                        'Roti Bakar Bandung Special' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?q=80&w=200&auto=format&fit=crop',
                                        'Wedang Ronde Jahe Merah' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?q=80&w=200&auto=format&fit=crop',
                                        'Es Kelapa Muda Jeruk' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?q=80&w=200&auto=format&fit=crop',
                                        'Teh Sereh Lemon Hangat' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=200&auto=format&fit=crop',
                                    ];
                                    $defaultImage = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=200&auto=format&fit=crop';
                                    
                                    // If image is uploaded locally, load from public/img, else Unsplash mapping
                                    $menuImage = $menu->image_path 
                                        ? asset('img/' . $menu->image_path)
                                        : ($imageMap[$menu->name] ?? $defaultImage);
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    {{-- Foto --}}
                                    <td class="py-4 px-6">
                                        <div class="w-14 h-14 rounded-xl overflow-hidden bg-slate-100 border border-slate-100 shadow-inner flex-shrink-0">
                                            <img src="{{ $menuImage }}" alt="{{ $menu->name }}" class="w-full h-full object-cover">
                                        </div>
                                    </td>

                                    {{-- Nama --}}
                                    <td class="py-4 px-6 font-semibold text-slate-900">
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm leading-snug">{{ $menu->name }}</p>
                                            <p class="text-xs text-slate-400 line-clamp-1 mt-0.5 font-normal max-w-xs">{{ $menu->description }}</p>
                                        </div>
                                    </td>

                                    {{-- Kategori --}}
                                    <td class="py-4 px-6">
                                        @if($menu->category === 'Makanan Utama')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-100">
                                                🍲 Makanan Utama
                                            </span>
                                        @elseif($menu->category === 'Dessert')
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-pink-50 text-pink-800 border border-pink-100">
                                                🍰 Dessert
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-800 border border-blue-100">
                                                🥤 Minuman
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Harga --}}
                                    <td class="py-4 px-6 font-black text-emerald-800">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="py-4 px-6">
                                        <form action="{{ route('admin.restaurant.toggle', $menu->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold transition-all duration-200 cursor-pointer hover:scale-105 active:scale-95 shadow-sm
                                                    {{ $menu->status === 'tersedia'
                                                        ? 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                                                        : 'bg-red-50 text-red-700 border border-red-200'
                                                    }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $menu->status === 'tersedia' ? 'bg-emerald-500 animate-pulse' : 'bg-red-500' }}"></span>
                                                {{ ucfirst($menu->status) }}
                                            </button>
                                        </form>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-4 px-6 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            {{-- Edit --}}
                                            <button onclick="openEditModal({{ json_encode($menu) }})"
                                                    class="w-9 h-9 rounded-xl border border-slate-200 hover:border-emerald-200 bg-white hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 flex items-center justify-center transition shadow-sm"
                                                    title="Edit Item">
                                                📝
                                            </button>

                                            {{-- Delete --}}
                                            <button onclick="openDeleteModal('{{ $menu->id }}', '{{ $menu->name }}')"
                                                    class="w-9 h-9 rounded-xl border border-slate-200 hover:border-red-200 bg-white hover:bg-red-50 text-slate-600 hover:text-red-600 flex items-center justify-center transition shadow-sm"
                                                    title="Hapus Item">
                                                🗑️
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-slate-400">
                                        <span class="text-3xl block mb-2">🥗</span>
                                        Belum ada data menu hidangan. Silakan tambah menu baru.
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

{{-- Add Modal --}}
<div id="modal-add" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-8 overflow-hidden flex flex-col" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
            <h3 class="text-xl font-bold text-slate-900 font-serif-luxury flex items-center gap-2">
                <span>🍳</span> Tambah Menu Baru
            </h3>
            <button onclick="closeModal('modal-add')" class="text-slate-400 hover:text-slate-600 text-lg">✕</button>
        </div>

        <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                {{-- Nama --}}
                <div class="col-span-2 space-y-1">
                    <label for="add-name" class="text-xs font-bold text-slate-500 uppercase">Nama Hidangan *</label>
                    <input type="text" id="add-name" name="name" required placeholder="Contoh: Iga Bakar Sambal Korek"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                </div>

                {{-- Kategori --}}
                <div class="space-y-1">
                    <label for="add-category" class="text-xs font-bold text-slate-500 uppercase">Kategori *</label>
                    <select id="add-category" name="category" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                        <option value="Makanan Utama">Makanan Utama</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>

                {{-- Harga --}}
                <div class="space-y-1">
                    <label for="add-price" class="text-xs font-bold text-slate-500 uppercase">Harga (Rupiah) *</label>
                    <input type="number" id="add-price" name="price" required placeholder="Contoh: 65000" min="0"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                </div>

                {{-- Deskripsi --}}
                <div class="col-span-2 space-y-1">
                    <label for="add-desc" class="text-xs font-bold text-slate-500 uppercase">Deskripsi Hidangan</label>
                    <textarea id="add-desc" name="description" rows="3" placeholder="Sebutkan bahan utama atau tingkat kepedasan..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors"></textarea>
                </div>

                {{-- Status --}}
                <div class="space-y-1">
                    <label for="add-status" class="text-xs font-bold text-slate-500 uppercase">Status Awal *</label>
                    <select id="add-status" name="status" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                {{-- Foto Menu --}}
                <div class="space-y-1">
                    <label for="add-image" class="text-xs font-bold text-slate-500 uppercase">Upload Foto Hidangan</label>
                    <input type="file" id="add-image" name="image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('modal-add')"
                        class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-emerald-800 hover:bg-emerald-950 text-white font-bold text-sm transition shadow shadow-emerald-800/10 cursor-pointer">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="modal-edit" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-lg w-full p-8 overflow-hidden flex flex-col" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
            <h3 class="text-xl font-bold text-slate-900 font-serif-luxury flex items-center gap-2">
                <span>📝</span> Edit Menu Hidangan
            </h3>
            <button onclick="closeModal('modal-edit')" class="text-slate-400 hover:text-slate-600 text-lg">✕</button>
        </div>

        <form id="edit-form" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                {{-- Nama --}}
                <div class="col-span-2 space-y-1">
                    <label for="edit-name" class="text-xs font-bold text-slate-500 uppercase">Nama Hidangan *</label>
                    <input type="text" id="edit-name" name="name" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                </div>

                {{-- Kategori --}}
                <div class="space-y-1">
                    <label for="edit-category" class="text-xs font-bold text-slate-500 uppercase">Kategori *</label>
                    <select id="edit-category" name="category" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                        <option value="Makanan Utama">Makanan Utama</option>
                        <option value="Dessert">Dessert</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>

                {{-- Harga --}}
                <div class="space-y-1">
                    <label for="edit-price" class="text-xs font-bold text-slate-500 uppercase">Harga (Rupiah) *</label>
                    <input type="number" id="edit-price" name="price" required min="0"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                </div>

                {{-- Deskripsi --}}
                <div class="col-span-2 space-y-1">
                    <label for="edit-desc" class="text-xs font-bold text-slate-500 uppercase">Deskripsi Hidangan</label>
                    <textarea id="edit-desc" name="description" rows="3"
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors"></textarea>
                </div>

                {{-- Status --}}
                <div class="space-y-1">
                    <label for="edit-status" class="text-xs font-bold text-slate-500 uppercase">Status *</label>
                    <select id="edit-status" name="status" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                {{-- Foto Menu --}}
                <div class="space-y-1">
                    <label for="edit-image" class="text-xs font-bold text-slate-500 uppercase">Ganti Foto Hidangan</label>
                    <input type="file" id="edit-image" name="image" accept="image/*"
                           class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t border-slate-100 mt-6">
                <button type="button" onclick="closeModal('modal-edit')"
                        class="flex-1 py-3 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-3 rounded-xl bg-emerald-800 hover:bg-emerald-950 text-white font-bold text-sm transition shadow shadow-emerald-800/10 cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div id="modal-delete" class="hidden fixed inset-0 z-[200] flex items-center justify-center modal-backdrop px-4">
    <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center" onclick="event.stopPropagation()">
        <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center text-3xl mx-auto mb-5">⚠️</div>
        <h3 class="text-xl font-bold text-slate-900 mb-2 font-serif-luxury">Hapus Menu Hidangan</h3>
        <p class="text-slate-500 text-sm mb-1">Anda akan menghapus menu hidangan secara <strong class="text-rose-600">permanen</strong>:</p>
        <p id="modal-delete-name" class="text-slate-900 font-bold text-base mb-6 bg-slate-50 rounded-xl py-2 px-4 border border-slate-100"></p>
        <p class="text-slate-400 text-xs mb-6">Tindakan ini tidak dapat dibatalkan.</p>
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

    // Modal helpers
    function openAddModal() {
        document.getElementById('modal-add').classList.remove('hidden');
    }

    function openEditModal(menu) {
        document.getElementById('edit-name').value = menu.name;
        document.getElementById('edit-category').value = menu.category;
        document.getElementById('edit-price').value = menu.price;
        document.getElementById('edit-desc').value = menu.description || '';
        document.getElementById('edit-status').value = menu.status;
        
        // Update form action dynamically
        const form = document.getElementById('edit-form');
        form.action = `/admin/restaurant/${menu.id}`;

        document.getElementById('modal-edit').classList.remove('hidden');
    }

    function openDeleteModal(id, name) {
        document.getElementById('modal-delete-name').innerText = name;
        
        // Update form action dynamically
        const form = document.getElementById('delete-form');
        form.action = `/admin/restaurant/${id}`;

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
