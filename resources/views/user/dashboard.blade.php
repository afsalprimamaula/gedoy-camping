<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Extranet Portal – Gedoy Camping Park</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom scrollbar for content areas */
        .custom-scroll::-webkit-scrollbar {
            height: 5px;
            width: 5px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: #f8fafc;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Custom styling for tabs active state */
        .tab-btn-active {
            background-color: #f59e0b !important; /* amber-500 */
            color: #ffffff !important;
            font-weight: 700;
        }

        /* Status badge styling */
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        .badge-confirmed {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .badge-cancelled {
            background-color: #ffe4e6;
            color: #9f1239;
            border: 1px solid #fecdd3;
        }

        /* Bank indicator line */
        .bank-accent {
            border-left: 3px solid #059669;
            background: rgba(5, 150, 105, 0.03);
        }

        /* Pulse for WhatsApp action button */
        @keyframes waPulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.4); }
            50% { box-shadow: 0 0 0 8px rgba(37, 211, 102, 0); }
        }
        .pulse-wa {
            animation: waPulse 2s ease-in-out infinite;
        }

        /* Strength bar transition */
        .strength-bar {
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        /* Star rating hover states */
        .star-btn {
            transition: transform 0.1s ease, color 0.1s ease;
        }
        .star-btn:hover {
            transform: scale(1.15);
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased overflow-hidden">

    {{-- Mobile Sidebar Drawer Overlay Backdrop --}}
    <div id="mobile-sidebar-backdrop" 
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden md:hidden transition-opacity duration-300"
         onclick="closeMobileSidebar()"></div>

    {{-- Main Container Layout --}}
    <div class="h-screen w-full flex overflow-hidden bg-slate-50">

        {{-- SISI KIRI: FIXED CUSTOMER SIDEBAR --}}
        <aside id="customer-sidebar" 
               class="w-64 bg-emerald-950 text-white flex flex-col justify-between shadow-2xl shrink-0 h-full 
                      fixed md:static inset-y-0 left-0 z-50 -translate-x-full md:translate-x-0 transition-transform duration-300 ease-out">
            
            <div class="flex flex-col flex-1 min-h-0">
                {{-- Header Brand --}}
                <div class="px-6 py-5 border-b border-emerald-900/50 flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-xl shadow-lg shadow-amber-500/25">
                            ⛺
                        </div>
                        <div>
                            <h2 class="text-white font-black text-base tracking-wide leading-none">GedoyUser</h2>
                            <p class="text-emerald-400 text-[10px] font-bold uppercase tracking-widest mt-1">Customer Portal</p>
                        </div>
                    </div>
                </div>

                {{-- Navigation Menu Items --}}
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scroll">
                    <p class="px-3 text-[10px] font-black uppercase tracking-widest text-emerald-500/55 mb-2">Main Navigation</p>
                    
                    {{-- Menu 1 --}}
                    <button onclick="switchTab('dashboard')" 
                            id="btn-tab-dashboard"
                            class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-100/80 hover:bg-white/5 hover:text-white transition-all duration-200 tab-btn-active">
                        <span class="text-base leading-none">📊</span>
                        <span>Dashboard Utama</span>
                    </button>

                    {{-- Menu 2 --}}
                    <button onclick="switchTab('password')" 
                            id="btn-tab-password"
                            class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-100/80 hover:bg-white/5 hover:text-white transition-all duration-200">
                        <span class="text-base leading-none">🔒</span>
                        <span>Ubah Password</span>
                    </button>

                    {{-- Menu 3 --}}
                    <button onclick="switchTab('reviews')" 
                            id="btn-tab-reviews"
                            class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-100/80 hover:bg-white/5 hover:text-white transition-all duration-200">
                        <span class="text-base leading-none">⭐</span>
                        <span>Ulasan Paket</span>
                    </button>

                    {{-- Menu 4 --}}
                    <button onclick="switchTab('orders')" 
                            id="btn-tab-orders"
                            class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-100/80 hover:bg-white/5 hover:text-white transition-all duration-200">
                        <span class="text-base leading-none">🍳</span>
                        <span>Pesanan Restoran</span>
                    </button>
                </nav>
            </div>

            {{-- Bottom Profile Card --}}
            <div class="p-4 border-t border-emerald-900/50 bg-emerald-950/40 flex-shrink-0">
                <div class="flex items-center gap-3 bg-emerald-900/30 p-3 rounded-2xl border border-emerald-900/40">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center text-emerald-950 font-black text-lg shadow-md shrink-0">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-bold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                        <span class="inline-flex items-center text-[9px] font-bold uppercase tracking-wider text-emerald-300 mt-0.5">
                            Customer Member
                        </span>
                    </div>
                </div>
            </div>
        </aside>

        {{-- SISI KANAN: WORKSPACE KONTEN --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden h-full">
            
            {{-- Top Header Bar --}}
            <header class="h-16 bg-white border-b flex items-center justify-between px-8 shrink-0 shadow-sm z-30">
                <div class="flex items-center gap-4">
                    {{-- Hamburger Menu for Mobile --}}
                    <button onclick="openMobileSidebar()" 
                            class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    
                    {{-- Breadcrumb --}}
                    <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
                        <span>Customer System</span>
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        <span class="text-slate-600 font-bold" id="breadcrumb-current">Overview</span>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 transition shadow-sm">
                        🌐 Kembali ke Beranda
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-rose-50 border border-rose-100 text-xs font-bold text-rose-700 hover:bg-rose-100 transition shadow-sm">
                            🚪 Keluar
                        </button>
                    </form>
                </div>
            </header>

            {{-- Main Content Workspace --}}
            <main class="flex-1 overflow-y-auto p-6 md:p-8 space-y-8 custom-scroll">
                
                {{-- Welcome Header --}}
                <div class="bg-gradient-to-r from-emerald-900 to-emerald-950 rounded-3xl p-6 md:p-8 text-white relative overflow-hidden shadow-xl">
                    <div class="absolute inset-0 bg-pattern opacity-5 pointer-events-none"></div>
                    <div class="relative z-10">
                        <h1 class="text-2xl md:text-3xl font-black tracking-tight mb-2">Ruang Riwayat Reservasi Anda 👋</h1>
                        <p class="text-emerald-200 text-sm font-medium">Alamat Email Terdaftar: <span class="font-bold underline text-white">{{ Auth::user()->email }}</span></p>
                    </div>
                </div>

                {{-- Flash Notifications --}}
                @if(session('success'))
                    <div id="flash-success" class="flex items-center gap-4 bg-emerald-50 border border-emerald-200 rounded-2xl shadow-sm px-5 py-4 transition-all duration-300">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center text-xl shrink-0">✅</div>
                        <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                        <button onclick="document.getElementById('flash-success').remove()" class="text-slate-400 hover:text-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <script>
                        setTimeout(() => {
                            const el = document.getElementById('flash-success');
                            if(el) {
                                el.style.opacity = '0';
                                setTimeout(() => el.remove(), 300);
                            }
                        }, 5000);
                    </script>
                @endif

                @if(session('error') || $errors->any())
                    <div id="flash-error" class="flex items-center gap-4 bg-rose-50 border border-rose-200 rounded-2xl shadow-sm px-5 py-4">
                        <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center text-xl shrink-0">❌</div>
                        <div class="flex-1">
                            @if(session('error'))
                                <p class="text-sm font-bold text-rose-800">{{ session('error') }}</p>
                            @endif
                            @foreach($errors->all() as $error)
                                <p class="text-xs font-semibold text-rose-700 mt-0.5">• {{ $error }}</p>
                            @endforeach
                        </div>
                        <button onclick="document.getElementById('flash-error').remove()" class="text-slate-400 hover:text-slate-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- DYNAMIC PANE TAB: DASHBOARD UTAMA --}}
                <div id="pane-dashboard" class="tab-pane space-y-8">
                    
                    {{-- Metric Summary Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Card 1 --}}
                        <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl shrink-0">
                                📋
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Total Reservasi</p>
                                <h3 class="text-2xl font-black text-slate-900 leading-none">
                                    {{ $bookings->count() }} <span class="text-xs font-bold text-slate-500">Pemesanan</span>
                                </h3>
                            </div>
                        </div>

                        {{-- Card 2 --}}
                        <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl shrink-0">
                                ⏳
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Status Antrean</p>
                                <h3 class="text-2xl font-black text-slate-900 leading-none">
                                    {{ $bookings->where('status', 'pending')->count() }} <span class="text-xs font-bold text-slate-500">Menunggu ACC</span>
                                </h3>
                            </div>
                        </div>

                        {{-- Card 3 --}}
                        <div class="bg-white border border-slate-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl shrink-0">
                                💳
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider mb-1">Down Payment (DP) Required</p>
                                <h4 class="text-xs font-bold text-slate-700 leading-snug">
                                    Wajib Bayar 30% dari Total Tagihan
                                </h4>
                            </div>
                        </div>
                    </div>

                    {{-- 2-Column Content Layout --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                        
                        {{-- Left Column: Panduan Pembayaran (1/3) --}}
                        <div class="lg:col-span-1 space-y-6">
                            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                                <div class="px-6 py-5 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                                    <span class="text-xl shrink-0">💳</span>
                                    <div>
                                        <h2 class="text-sm font-black text-slate-900 leading-tight">Panduan Down Payment</h2>
                                        <p class="text-slate-400 text-[10px] font-semibold uppercase tracking-wider mt-0.5">Tata Cara Pembayaran</p>
                                    </div>
                                </div>
                                <div class="p-6 space-y-5">
                                    {{-- Banner --}}
                                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                                        <div class="flex gap-2.5">
                                            <span class="text-xl">⚡</span>
                                            <div>
                                                <p class="text-amber-900 font-bold text-xs leading-snug">DP 30% = Proses Persetujuan Cepat</p>
                                                <p class="text-amber-700 text-[11px] mt-1 leading-relaxed">
                                                    Transfer DP sebesar 30% ke rekening di bawah dan kirimkan bukti transfer melalui WhatsApp untuk konfirmasi cepat dari admin.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Steps --}}
                                    <div class="space-y-3">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Langkah Konfirmasi</p>
                                        
                                        <div class="flex items-start gap-3">
                                            <div class="w-5 h-5 rounded-md bg-emerald-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">1</div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-800">Lakukan Booking Paket</p>
                                                <p class="text-[11px] text-slate-400">Pilih paket dan isi data tamu</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="w-5 h-5 rounded-md bg-emerald-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">2</div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-800">Transfer DP 30%</p>
                                                <p class="text-[11px] text-slate-400">Transfer dana ke salah satu rekening resmi</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="w-5 h-5 rounded-md bg-emerald-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">3</div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-800">Kirim Bukti Pembayaran</p>
                                                <p class="text-[11px] text-slate-400">Hubungi admin WhatsApp dengan membawa kode reservasi</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start gap-3">
                                            <div class="w-5 h-5 rounded-md bg-emerald-600 text-white font-black text-xs flex items-center justify-center shrink-0 mt-0.5">4</div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-800">Reservasi Dikonfirmasi</p>
                                                <p class="text-[11px] text-slate-400">Admin akan menyetujui reservasi dalam 1×24 jam</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Bank Accounts --}}
                                    <div class="space-y-2.5 pt-2 border-t border-slate-100">
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Rekening Resmi</p>

                                        {{-- BCA --}}
                                        <div class="bank-accent p-3 rounded-xl flex items-center justify-between gap-3">
                                            <div>
                                                <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest leading-none">BCA</span>
                                                <p class="text-slate-850 font-black text-xs mt-0.5">123-456-7890</p>
                                                <p class="text-[10px] text-slate-400">a.n PT. Gedoy Wisata Alam</p>
                                            </div>
                                            <button onclick="copyToClipboard('123-456-7890', this)" 
                                                    class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 rounded-lg text-xs font-bold transition">
                                                📋
                                            </button>
                                        </div>

                                        {{-- BRI --}}
                                        <div class="bank-accent p-3 rounded-xl flex items-center justify-between gap-3" style="border-left-color: #0284c7;">
                                            <div>
                                                <span class="text-[10px] font-black text-sky-600 uppercase tracking-widest leading-none">BRI</span>
                                                <p class="text-slate-850 font-black text-xs mt-0.5">0987-654-3210</p>
                                                <p class="text-[10px] text-slate-400">a.n PT. Gedoy Wisata Alam</p>
                                            </div>
                                            <button onclick="copyToClipboard('0987-654-3210', this)" 
                                                    class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 rounded-lg text-xs font-bold transition">
                                                📋
                                            </button>
                                        </div>

                                        {{-- GOPAY --}}
                                        <div class="bank-accent p-3 rounded-xl flex items-center justify-between gap-3" style="border-left-color: #10b981;">
                                            <div>
                                                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest leading-none">GOPAY</span>
                                                <p class="text-slate-850 font-black text-xs mt-0.5">0812-2209-9317</p>
                                                <p class="text-[10px] text-slate-400">a.n Admin Gedoy Camping</p>
                                            </div>
                                            <button onclick="copyToClipboard('081222099317', this)" 
                                                    class="p-2 bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 rounded-lg text-xs font-bold transition">
                                                📋
                                            </button>
                                        </div>
                                    </div>

                                    {{-- WhatsApp Button --}}
                                    <a href="https://wa.me/6281222099317?text={{ urlencode('Halo Admin Gedoy Camping, saya ingin konfirmasi pembayaran DP 30% untuk reservasi saya. Mohon bantuannya!') }}" 
                                       target="_blank" 
                                       rel="noopener"
                                       class="w-full flex items-center justify-center gap-2 bg-[#25d366] hover:bg-[#20ba5a] text-white font-bold text-xs py-3 rounded-2xl transition shadow-lg shadow-green-500/25 pulse-wa">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                        Konfirmasi via WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column: Riwayat Reservasi (2/3) --}}
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                                {{-- Card Header --}}
                                <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-50/50">
                                    <div>
                                        <h2 class="text-sm font-black text-slate-900 leading-tight">Daftar Reservasi Aktif</h2>
                                        <p class="text-slate-400 text-[10px] font-semibold uppercase tracking-wider mt-0.5">Riwayat Pemesanan Wisata</p>
                                    </div>
                                    
                                    <a href="{{ route('home') }}#paket" 
                                       class="inline-flex items-center gap-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition shadow-md shadow-emerald-650/20 shrink-0 self-start sm:self-auto">
                                        ➕ Booking Baru
                                    </a>
                                </div>

                                {{-- Filter Tabs inside booking section --}}
                                <div class="px-6 pt-3 flex gap-2 flex-wrap border-b border-slate-100 bg-white">
                                    @foreach([
                                        ['key' => 'all',       'label' => 'Semua',      'count' => $bookings->count()],
                                        ['key' => 'pending',   'label' => 'Menunggu',   'count' => $bookings->where('status','pending')->count()],
                                        ['key' => 'confirmed', 'label' => 'Disetujui',  'count' => $bookings->where('status','confirmed')->count()],
                                        ['key' => 'cancelled', 'label' => 'Dibatalkan', 'count' => $bookings->where('status','cancelled')->count()],
                                    ] as $subtab)
                                        <button onclick="filterBookings('{{ $subtab['key'] }}')" 
                                                id="subtab-{{ $subtab['key'] }}"
                                                class="subtab-btn px-4 py-2.5 text-xs font-bold rounded-t-xl transition border-b-2 border-transparent text-slate-500 hover:text-slate-800 hover:bg-slate-50
                                                       {{ $subtab['key'] === 'all' ? 'text-emerald-700 border-emerald-600 bg-emerald-55/10' : '' }}">
                                            {{ $subtab['label'] }}
                                            @if($subtab['count'] > 0)
                                                <span class="ml-1 px-1.5 py-0.5 text-[9px] font-black rounded-full shrink-0
                                                       {{ $subtab['key'] === 'pending' ? 'bg-amber-100 text-amber-800' : ($subtab['key'] === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : ($subtab['key'] === 'cancelled' ? 'bg-rose-100 text-rose-800' : 'bg-slate-100 text-slate-600')) }}">
                                                    {{ $subtab['count'] }}
                                                </span>
                                            @endif
                                        </button>
                                    @endforeach
                                </div>

                                {{-- Bookings List container --}}
                                <div id="bookings-list-container" class="divide-y divide-slate-100">
                                    @forelse($bookings->sortByDesc('created_at') as $booking)
                                        @php
                                            $dpPrice = $booking->total_price * 0.3;
                                            $checkIn = \Carbon\Carbon::parse($booking->check_in_date);
                                            $checkOut = \Carbon\Carbon::parse($booking->check_out_date);
                                            $nightsCount = $checkIn->diffInDays($checkOut);
                                            
                                            $waTemplate = urlencode(
                                                "Halo Admin Gedoy Camping 👋\n" .
                                                "Saya ingin melakukan konfirmasi pembayaran DP untuk pesanan saya:\n\n" .
                                                "📋 Kode Booking : *{$booking->booking_code}*\n" .
                                                "⛺ Paket        : *{$booking->campingPackage?->name}*\n" .
                                                "💰 Total Tagihan: *Rp " . number_format($booking->total_price, 0, ',', '.') . "*\n" .
                                                "💵 Nominal DP   : *Rp " . number_format($dpPrice, 0, ',', '.') . "*\n\n" .
                                                "Mohon dapat segera diperiksa dan disetujui. Terima kasih banyak!"
                                            );
                                        @endphp

                                        <div class="booking-item-card p-6 hover:bg-slate-50/60 transition duration-150" 
                                             data-status="{{ $booking->status }}">
                                            
                                            <div class="flex flex-col md:flex-row gap-4 justify-between">
                                                
                                                {{-- Booking Info --}}
                                                <div class="space-y-3 flex-1 min-w-0">
                                                    {{-- Code & Status Badges --}}
                                                    <div class="flex flex-wrap items-center gap-2">
                                                        <code class="text-[11px] font-black text-emerald-800 bg-emerald-50 px-2 py-1 rounded-md border border-emerald-100 tracking-wider">
                                                            {{ $booking->booking_code }}
                                                        </code>
                                                        
                                                        @if($booking->status === 'pending')
                                                            <span class="badge-pending inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                                                Menunggu ACC Admin
                                                            </span>
                                                        @elseif($booking->status === 'confirmed')
                                                            <span class="badge-confirmed inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                                ✅ Disetujui
                                                            </span>
                                                        @elseif($booking->status === 'cancelled')
                                                            <span class="badge-cancelled inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                                                ❌ Batal
                                                            </span>
                                                        @else
                                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500 uppercase tracking-wider">
                                                                {{ $booking->status }}
                                                            </span>
                                                        @endif
                                                    </div>

                                                    {{-- Camping Package Name --}}
                                                    <h3 class="text-base font-black text-slate-900 leading-tight flex items-center gap-1.5">
                                                        <span>⛺</span> {{ $booking->campingPackage?->name ?? 'Paket Kustom' }}
                                                    </h3>

                                                    {{-- Detail Specs --}}
                                                    <div class="flex flex-wrap gap-x-4 gap-y-2 text-xs font-semibold text-slate-500">
                                                        <span class="flex items-center gap-1">
                                                            👥 <strong>{{ $booking->total_guests }}</strong> Tamu
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            📅 Masuk: <strong class="text-slate-800">{{ $checkIn->isoFormat('D MMM Y') }}</strong>
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            📅 Keluar: <strong class="text-slate-800">{{ $checkOut->isoFormat('D MMM Y') }}</strong>
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            🌙 <strong>{{ $nightsCount }}</strong> Malam
                                                        </span>
                                                    </div>

                                                    {{-- Mathematical Down Payment Calculations --}}
                                                    <div class="flex flex-wrap items-center gap-4 pt-1.5">
                                                        <div>
                                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider block">Total Biaya</span>
                                                            <p class="text-sm font-bold text-slate-850">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                                        </div>

                                                        {{-- Down Payment Required (30%) --}}
                                                        <div class="px-3 py-1.5 rounded-xl bg-amber-50 border border-amber-250 flex items-center gap-2">
                                                            <span class="text-sm">💵</span>
                                                            <div>
                                                                <span class="text-[8px] font-black text-amber-700 uppercase tracking-wider block leading-none">Wajib Bayar DP (30%)</span>
                                                                <p class="text-xs font-black text-amber-850 mt-0.5">Rp {{ number_format($dpPrice, 0, ',', '.') }}</p>
                                                            </div>
                                                        </div>

                                                        @if($booking->status === 'confirmed')
                                                            <div class="px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center gap-1.5">
                                                                <span class="text-[10px] font-black text-emerald-800">✅ Pembayaran Terkonfirmasi / Lunas</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- Action Buttons --}}
                                                <div class="flex flex-row md:flex-col gap-2 shrink-0 justify-end self-start md:self-auto w-full md:w-auto">
                                                    @if($booking->status === 'pending')
                                                        {{-- WhatsApp redirect link with dynamic pre-filled text --}}
                                                        <a href="https://wa.me/6281222099317?text={{ $waTemplate }}" 
                                                           target="_blank" 
                                                           rel="noopener"
                                                           class="flex-1 md:flex-initial text-center inline-flex items-center justify-center gap-1.5 bg-[#25d366] hover:bg-[#20ba5a] text-white font-bold text-[11px] px-4 py-2.5 rounded-xl transition shadow-md shadow-green-500/10">
                                                            📲 Konfirmasi DP (WA)
                                                        </a>
                                                    @endif

                                                    <button onclick="copyToClipboard('{{ $booking->booking_code }}', this)" 
                                                            class="flex-1 md:flex-initial inline-flex items-center justify-center gap-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold text-[11px] px-4 py-2.5 rounded-xl transition">
                                                        📋 Salin Kode
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    @empty
                                        <div class="py-16 px-6 text-center">
                                            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center text-4xl mx-auto mb-4">
                                                ⛺
                                            </div>
                                            <h4 class="text-base font-black text-slate-800 mb-1">Belum Ada Reservasi</h4>
                                            <p class="text-slate-400 text-xs max-w-sm mx-auto leading-relaxed mb-6">
                                                Anda belum mendaftarkan reservasi camping apa pun. Cari dan temukan liburan idaman Anda sekarang!
                                            </p>
                                            <a href="{{ route('home') }}#paket" 
                                               class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs px-5 py-3 rounded-xl transition shadow">
                                                ⛺ Cari Paket Camping
                                            </a>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            {{-- Bottom Warning Info Note --}}
                            <div class="bg-blue-50 border border-blue-200 rounded-3xl p-5 flex gap-3">
                                <span class="text-xl shrink-0 mt-0.5">💡</span>
                                <div>
                                    <p class="text-blue-900 font-bold text-xs">Informasi Tambahan:</p>
                                    <p class="text-blue-700 text-[11px] mt-1 leading-relaxed">
                                        Setelah melakukan booking baru, status pesanan Anda berada dalam antrean peninjauan oleh admin. Mohon mentransfer kewajiban Down Payment (DP) 30% dan mengunggah pesan konfirmasi ke nomor kontak Whatsapp admin untuk penyelesaian verifikasi dengan cepat.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- DYNAMIC PANE TAB: UBAH PASSWORD --}}
                <div id="pane-password" class="tab-pane hidden space-y-8">
                    <div class="max-w-2xl bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm">
                        <div class="border-b border-slate-100 pb-5 mb-6">
                            <h2 class="text-lg font-black text-slate-900 leading-tight">Pengaturan Keamanan</h2>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mt-1">Ubah Sandi Akun</p>
                        </div>

                        <form action="{{ route('user.updatePassword') }}" method="POST" id="form-password-change" class="space-y-5" novalidate>
                            @csrf
                            @method('PATCH')

                            {{-- Current Password --}}
                            <div>
                                <label for="current_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                                    Password Saat Ini <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="current_password" 
                                           name="current_password" 
                                           autocomplete="current-password"
                                           placeholder="Masukkan kata sandi lama Anda"
                                           class="w-full pl-4 pr-12 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 bg-white placeholder-slate-350 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-650/10 outline-none transition duration-150">
                                    
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('current_password', 'icon-current')" 
                                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition">
                                        <svg id="icon-current" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            {{-- New Password --}}
                            <div>
                                <label for="new_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                                    Password Baru <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="new_password" 
                                           name="password" 
                                           autocomplete="new-password"
                                           placeholder="Gunakan minimal 8 karakter"
                                           oninput="checkPasswordStrength(this.value)"
                                           class="w-full pl-4 pr-12 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 bg-white placeholder-slate-355 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-650/10 outline-none transition duration-150">
                                    
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('new_password', 'icon-new')" 
                                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition">
                                        <svg id="icon-new" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Password Strength Meter --}}
                                <div class="mt-3" id="pwd-strength-container">
                                    <div class="flex gap-1.5 mb-1.5">
                                        <div class="flex-1 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                            <div id="pwd-bar-1" class="strength-bar h-full w-0"></div>
                                        </div>
                                        <div class="flex-1 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                            <div id="pwd-bar-2" class="strength-bar h-full w-0"></div>
                                        </div>
                                        <div class="flex-1 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                            <div id="pwd-bar-3" class="strength-bar h-full w-0"></div>
                                        </div>
                                        <div class="flex-1 h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                            <div id="pwd-bar-4" class="strength-bar h-full w-0"></div>
                                        </div>
                                    </div>
                                    <p id="pwd-strength-text" class="text-[10px] font-bold text-slate-400 uppercase tracking-wide"></p>
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div>
                                <label for="confirm_password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                                    Konfirmasi Password Baru <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           id="confirm_password" 
                                           name="password_confirmation" 
                                           autocomplete="new-password"
                                           placeholder="Ulangi password baru Anda"
                                           oninput="checkPasswordMatch()"
                                           class="w-full pl-4 pr-12 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 bg-white placeholder-slate-355 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-655/10 outline-none transition duration-150">
                                    
                                    <button type="button" 
                                            onclick="togglePasswordVisibility('confirm_password', 'icon-confirm')" 
                                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition">
                                        <svg id="icon-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p id="pwd-match-message" class="text-[11px] font-bold mt-1.5 hidden"></p>
                            </div>

                            {{-- Submit --}}
                            <button type="submit" 
                                    id="btn-submit-password" 
                                    class="w-full flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-850 text-white font-bold text-sm py-3.5 rounded-2xl transition shadow-lg shadow-slate-900/10">
                                🔑 Perbarui Password Akun
                            </button>
                        </form>
                    </div>
                </div>

                {{-- DYNAMIC PANE TAB: ULASAN PAKET --}}
                <div id="pane-reviews" class="tab-pane hidden space-y-8">
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm">
                        <div class="border-b border-slate-100 pb-5 mb-6">
                            <h2 class="text-lg font-black text-slate-900 leading-tight">Ulasan Paket Kemah</h2>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mt-1">Bagikan Pengalaman Menginap Anda</p>
                        </div>

                        {{-- Confirmed Bookings list for Reviews --}}
                        @php
                            $confirmedBookings = $bookings->where('status', 'confirmed');
                        @endphp

                        @if($confirmedBookings->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="reviews-list-container">
                                @foreach($confirmedBookings as $reviewBooking)
                                    <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-white transition duration-200 space-y-4" 
                                         id="review-card-{{ $reviewBooking->booking_code }}">
                                        
                                        <div class="flex items-center justify-between border-b border-slate-150/40 pb-3">
                                            <div>
                                                <code class="text-[10px] font-bold text-slate-500 bg-slate-200 px-2 py-0.5 rounded">
                                                    {{ $reviewBooking->booking_code }}
                                                </code>
                                                <h4 class="text-sm font-black text-slate-900 mt-1">
                                                    {{ $reviewBooking->campingPackage?->name ?? 'Paket Kemah' }}
                                                </h4>
                                            </div>
                                            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg border border-emerald-100">
                                                Selesai
                                            </span>
                                        </div>

                                        {{-- Rating Form --}}
                                        <form onsubmit="submitMockReview(event, '{{ $reviewBooking->booking_code }}')" class="space-y-4">
                                            {{-- Star Rating Buttons --}}
                                            <div>
                                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">
                                                    Rating Anda <span class="text-rose-500">*</span>
                                                </label>
                                                <div class="flex gap-2 text-slate-300">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <button type="button" 
                                                                onclick="selectRating('{{ $reviewBooking->booking_code }}', {{ $i }})"
                                                                id="star-{{ $reviewBooking->booking_code }}-{{ $i }}"
                                                                class="star-btn text-2xl focus:outline-none">
                                                            ★
                                                        </button>
                                                    @endfor
                                                </div>
                                                <input type="hidden" 
                                                       name="rating" 
                                                       id="input-rating-{{ $reviewBooking->booking_code }}" 
                                                       required>
                                            </div>

                                            {{-- Textarea Feedback --}}
                                            <div>
                                                <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1.5">
                                                    Ulasan Pengalaman <span class="text-rose-500">*</span>
                                                </label>
                                                <textarea name="feedback" 
                                                          rows="3" 
                                                          required
                                                          placeholder="Ceritakan bagaimana keindahan pemandangan, kenyamanan fasilitas, dan keramahan pelayanan kami di Nagrak, Ciater, Subang..."
                                                          class="w-full p-3.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 bg-white placeholder-slate-300 focus:border-emerald-600 focus:ring-4 focus:ring-emerald-600/10 outline-none transition"></textarea>
                                            </div>

                                            <button type="submit" 
                                                    id="btn-submit-review-{{ $reviewBooking->booking_code }}"
                                                    class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs transition shadow-md shadow-emerald-700/15">
                                                ✍️ Kirim Ulasan
                                            </button>
                                        </form>

                                        {{-- Mock success message --}}
                                        <div id="review-success-{{ $reviewBooking->booking_code }}" class="hidden p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-center">
                                            <p class="text-xs font-black text-emerald-850">✅ Terima kasih atas ulasan Anda!</p>
                                            <p class="text-[10px] text-emerald-600 mt-0.5">Ulasan telah tersimpan ke dalam database extranet Gedoy Camping Park.</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="py-16 px-6 text-center border-2 border-dashed border-slate-250/60 rounded-3xl">
                                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center text-4xl mx-auto mb-4 border border-amber-100">
                                    ⭐
                                </div>
                                <h4 class="text-base font-black text-slate-800 mb-1">Belum Ada Paket Untuk Diulas</h4>
                                <p class="text-slate-400 text-xs max-w-sm mx-auto leading-relaxed">
                                    Ulasan baru dapat diajukan setelah status reservasi Anda disetujui dan berstatus dikonfirmasi oleh admin. Mari rasakan keindahan wisata kami terlebih dahulu!
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- DYNAMIC PANE TAB: PESANAN RESTORAN --}}
                <div id="pane-orders" class="tab-pane hidden space-y-8">
                    <div class="bg-white border border-slate-200 rounded-3xl p-6 md:p-8 shadow-sm">
                        <div class="border-b border-slate-100 pb-5 mb-6">
                            <h2 class="text-lg font-black text-slate-900 leading-tight">Riwayat Pesanan Restoran Anda</h2>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mt-1">Daftar hidangan kuliner yang dipesan ke tenda Anda</p>
                        </div>

                        @if($restaurantOrders->isNotEmpty())
                            <div class="space-y-6">
                                @foreach($restaurantOrders as $order)
                                    <div class="border border-slate-150 rounded-2xl p-6 hover:shadow-md transition-all duration-300 bg-[#fbfbf9]/40">
                                        {{-- Header row of order --}}
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center font-bold text-sm shadow-inner">
                                                    🍳
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-slate-800 text-sm">Pesanan #GDY-FB-{{ $order->id }}</h4>
                                                    <p class="text-[11px] text-slate-400 mt-0.5">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                                                </div>
                                            </div>

                                            <div class="flex items-center gap-3">
                                                {{-- Tent --}}
                                                <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-xl border border-slate-200">
                                                    ⛺ {{ $order->tenda_number }}
                                                </span>

                                                {{-- Delivery time --}}
                                                <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-800 text-xs font-semibold px-3 py-1.5 rounded-xl border border-amber-100">
                                                    🕐 {{ $order->delivery_time }}
                                                </span>

                                                {{-- Status Badge --}}
                                                @if($order->status === 'pending')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200 pulse-soft">
                                                        ⏳ Pending
                                                    </span>
                                                @elseif($order->status === 'processing')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                        👨‍🍳 Sedang Dimasak
                                                    </span>
                                                @elseif($order->status === 'completed')
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-250">
                                                        ✅ Selesai Diantar
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                        ❌ Dibatalkan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Items ordered --}}
                                        <div class="py-4">
                                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Item Hidangan:</p>
                                            <div class="space-y-2">
                                                @foreach($order->items as $item)
                                                    <div class="flex items-center justify-between text-sm text-slate-700">
                                                        <div class="flex items-center gap-2">
                                                            <span class="font-bold text-slate-800">{{ $item->quantity }}x</span>
                                                            <span>{{ $item->menu->name ?? 'Menu Terhapus' }}</span>
                                                        </div>
                                                        <span class="font-semibold text-slate-900">
                                                            Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                                        </span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Footer details --}}
                                        <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs">
                                            <span class="text-slate-400 font-medium">Pembayaran akan dimasukkan ke tagihan akhir check-out tenda Anda.</span>
                                            
                                            <div class="flex items-center gap-6">
                                                <div class="text-right">
                                                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Subtotal</span>
                                                    <span class="font-bold text-slate-700">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="text-right">
                                                    <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Pajak (11%)</span>
                                                    <span class="font-bold text-slate-700">Rp {{ number_format($order->tax, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="text-right bg-emerald-50/50 border border-emerald-100 rounded-xl px-4 py-2">
                                                    <span class="text-emerald-700 block text-[9px] uppercase font-black tracking-wider">Total Tagihan</span>
                                                    <span class="font-black text-emerald-800 text-sm">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Empty state --}}
                            <div class="py-16 px-6 text-center border-2 border-dashed border-slate-200/60 rounded-3xl">
                                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-4xl mx-auto mb-4 border border-emerald-100">
                                    🍳
                                </div>
                                <h4 class="text-base font-black text-slate-800 mb-1">Belum Ada Pesanan Restoran</h4>
                                <p class="text-slate-400 text-xs max-w-sm mx-auto leading-relaxed">
                                    Anda belum memesan makanan atau minuman dari Restoran Gedoy. Nikmati hidangan lezat hangat kami yang siap diantarkan langsung ke tenda Anda.
                                </p>
                                <a href="{{ route('restaurant.index') }}" target="_blank"
                                   class="mt-6 inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-950 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition duration-200 shadow">
                                    Pesan Kuliner Sekarang ➔
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

            </main>
        </div>

    </div>

    {{-- SCRIPTS Penunjang Fitur H-Screen Extranet --}}
    <script>
        (function() {
            
            // ── TAB SWITCHER LOGIC ──────────────────────────────────────────
            window.switchTab = function(tabName) {
                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });
                
                // Show selected tab pane
                const targetPane = document.getElementById('pane-' + tabName);
                if(targetPane) targetPane.classList.remove('hidden');

                // Update active classes on buttons
                document.querySelectorAll('.tab-btn').forEach(btn => {
                    btn.classList.remove('tab-btn-active');
                });
                const activeBtn = document.getElementById('btn-tab-' + tabName);
                if(activeBtn) activeBtn.classList.add('tab-btn-active');

                // Update breadcrumb text
                const breadcrumbMap = {
                    'dashboard': 'Overview / Dashboard Utama',
                    'password': 'Security / Ubah Password',
                    'reviews': 'Feedback / Ulasan Paket',
                    'orders': 'Culinary / Pesanan Restoran'
                };
                const crumb = document.getElementById('breadcrumb-current');
                if(crumb && breadcrumbMap[tabName]) {
                    crumb.textContent = breadcrumbMap[tabName];
                }

                // Close mobile sidebar on transition
                closeMobileSidebar();
            };

            // ── MOBILE SIDEBAR DRAWER CONTROL ──────────────────────────────────
            window.openMobileSidebar = function() {
                const sidebar = document.getElementById('customer-sidebar');
                const backdrop = document.getElementById('mobile-sidebar-backdrop');
                
                if(sidebar && backdrop) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                    backdrop.style.opacity = '1';
                }
            };

            window.closeMobileSidebar = function() {
                const sidebar = document.getElementById('customer-sidebar');
                const backdrop = document.getElementById('mobile-sidebar-backdrop');
                
                if(sidebar && backdrop) {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                    backdrop.style.opacity = '0';
                }
            };

            // ── COPY TO CLIPBOARD ───────────────────────────────────────────
            window.copyToClipboard = function(text, btn) {
                navigator.clipboard.writeText(text).then(() => {
                    const originalContent = btn.innerHTML;
                    btn.innerHTML = '✅';
                    btn.style.color = '#059669';
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.style.color = '';
                    }, 2000);
                }).catch(() => {
                    // Fallback
                    const input = document.createElement('textarea');
                    input.value = text;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    
                    const originalContent = btn.innerHTML;
                    btn.innerHTML = '✅';
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                    }, 2000);
                });
            };

            // ── BOOKING FILTER FUNCTION ──────────────────────────────────────
            window.filterBookings = function(status) {
                // Update subtab buttons state
                document.querySelectorAll('.subtab-btn').forEach(btn => {
                    btn.classList.remove('text-emerald-700', 'border-emerald-600', 'bg-emerald-55/10');
                    btn.classList.add('text-slate-500');
                });
                const activeBtn = document.getElementById('subtab-' + status);
                if(activeBtn) {
                    activeBtn.classList.remove('text-slate-500');
                    activeBtn.classList.add('text-emerald-700', 'border-emerald-600', 'bg-emerald-55/10');
                }

                // Show/hide cards
                document.querySelectorAll('.booking-item-card').forEach(card => {
                    const cardStatus = card.getAttribute('data-status');
                    if(status === 'all' || cardStatus === status) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            };

            // ── PASSWORD VISIBILITY TOGGLE ──────────────────────────────────
            window.togglePasswordVisibility = function(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                if(input && icon) {
                    const isPass = input.type === 'password';
                    input.type = isPass ? 'text' : 'password';
                    
                    if(isPass) {
                        // Eye-off icon
                        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`;
                    } else {
                        // Eye-on icon
                        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                    }
                }
            };

            // ── PASSWORD STRENGTH CHECKER ───────────────────────────────────
            window.checkPasswordStrength = function(val) {
                let score = 0;
                if(val.length >= 8) score++;
                if(/[A-Z]/.test(val)) score++;
                if(/[0-9]/.test(val)) score++;
                if(/[^a-zA-Z0-9]/.test(val)) score++;

                const bars = ['pwd-bar-1', 'pwd-bar-2', 'pwd-bar-3', 'pwd-bar-4'];
                const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
                const labels = ['Sangat Lemah', 'Lemah', 'Cukup Kuat', 'Sangat Kuat'];

                bars.forEach((id, i) => {
                    const el = document.getElementById(id);
                    if(i < score) {
                        el.style.width = '100%';
                        el.style.backgroundColor = colors[score - 1];
                    } else {
                        el.style.width = '0%';
                        el.style.backgroundColor = '';
                    }
                });

                const label = document.getElementById('pwd-strength-text');
                if(val.length === 0) {
                    label.textContent = '';
                } else {
                    label.textContent = labels[score - 1] || 'Sangat Lemah';
                    label.style.color = colors[score - 1] || '#ef4444';
                }
            };

            // ── PASSWORD MATCH VERIFICATION ─────────────────────────────────
            window.checkPasswordMatch = function() {
                const pass = document.getElementById('new_password').value;
                const confirm = document.getElementById('confirm_password').value;
                const message = document.getElementById('pwd-match-message');
                const btn = document.getElementById('btn-submit-password');

                if(confirm.length === 0) {
                    message.classList.add('hidden');
                    return;
                }

                message.classList.remove('hidden');
                
                if(pass === confirm) {
                    message.textContent = '✅ Password cocok';
                    message.style.color = '#059669';
                    btn.disabled = false;
                    btn.style.opacity = '1';
                } else {
                    message.textContent = '❌ Password tidak cocok';
                    message.style.color = '#e11d48';
                    btn.disabled = true;
                    btn.style.opacity = '0.6';
                }
            };

            // ── PASSWORD FORM SUBMISSION LOADING STATE ───────────────────────
            const pwForm = document.getElementById('form-password-change');
            if(pwForm) {
                pwForm.addEventListener('submit', function() {
                    const btn = document.getElementById('btn-submit-password');
                    btn.disabled = true;
                    btn.innerHTML = `<svg class="w-4 h-4 animate-spin text-white mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg> Memperbarui...`;
                });
            }

            // ── STAR RATING INTERACTIVE SYSTEM ──────────────────────────────
            window.selectRating = function(code, ratingValue) {
                // Set hidden input value
                const input = document.getElementById('input-rating-' + code);
                if(input) input.value = ratingValue;

                // Color stars
                for(let i = 1; i <= 5; i++) {
                    const star = document.getElementById('star-' + code + '-' + i);
                    if(i <= ratingValue) {
                        star.style.color = '#f59e0b'; // Gold
                    } else {
                        star.style.color = '#cbd5e1'; // Gray
                    }
                }
            };

            // ── MOCK REVIEW SUBMISSION ──────────────────────────────────────
            window.submitMockReview = function(e, code) {
                e.preventDefault();
                const form = e.target;
                const formButton = document.getElementById('btn-submit-review-' + code);
                const successMsg = document.getElementById('review-success-' + code);

                // Change loading state
                formButton.disabled = true;
                formButton.innerHTML = 'Mengirimkan...';

                setTimeout(() => {
                    form.classList.add('hidden');
                    successMsg.classList.remove('hidden');
                }, 800);
            };

            // Auto switch tab if 'tab' parameter is in query string
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            if (tabParam) {
                switchTab(tabParam);
            }
        })();
    </script>
</body>
</html>
