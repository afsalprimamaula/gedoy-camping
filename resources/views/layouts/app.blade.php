<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gedoy Camping Park – Destinasi glamping premium di tepi sungai dan alam terbuka Ciater, Subang. Booking online mudah dan cepat.">
    <meta name="keywords" content="gedoy camping, glamping ciater, river camp, sewa tempat camping, camping subang, wisata alam">
    <meta name="author" content="Gedoy Camping Park">
    <meta property="og:title" content="Gedoy Camping Park – Glamping Premium di Ciater">
    <meta property="og:description" content="Nikmati ketenangan alam di Ciater bersama orang-orang terkasih. Booking sekarang!">
    <meta property="og:type" content="website">

    <title>@yield('title', 'Gedoy Camping Park – Glamping Premium Ciater')</title>

    {{-- Google Fonts: Premium Typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --forest: #1a3a2a;
            --forest-mid: #2d5a3d;
            --forest-light: #4a7c59;
            --gold: #d4a843;
            --gold-light: #f0c96a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f7f4;
            color: #1a1a1a;
        }

        .font-serif-luxury {
            font-family: 'Cormorant Garamond', serif;
        }

        /* Glassmorphism Navbar */
        .navbar-glass {
            background: rgba(15, 35, 22, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 168, 67, 0.2);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f2316; }
        ::-webkit-scrollbar-thumb { background: #d4a843; border-radius: 3px; }

        /* Dropdown animation */
        @keyframes dropIn {
            from { opacity: 0; transform: translateY(-8px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        .dropdown-open { animation: dropIn 0.18s ease-out forwards; }

        /* Mobile menu slide */
        @keyframes slideDown {
            from { opacity: 0; max-height: 0; }
            to   { opacity: 1; max-height: 600px; }
        }
        .mobile-menu-open { animation: slideDown 0.3s ease-out forwards; }

        /* Alert slide-in */
        @keyframes slideInTop {
            from { opacity: 0; transform: translateX(-50%) translateY(-20px); }
            to   { opacity: 1; transform: translateX(-50%) translateY(0); }
        }
        .alert-enter { animation: slideInTop 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; }

        /* Nav link hover underline */
        .nav-link {
            position: relative;
            padding-bottom: 2px;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0;
            width: 0; height: 1.5px;
            background: #d4a843;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* Gold gradient text */
        .text-gold-gradient {
            background: linear-gradient(135deg, #d4a843 0%, #f0c96a 50%, #d4a843 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Footer gradient */
        .footer-bg {
            background: linear-gradient(160deg, #0a1f12 0%, #0f2a1a 50%, #091810 100%);
        }
    </style>
</head>

<body class="antialiased">

    {{-- =============================================
         STICKY NAVBAR – Glassmorphism
    ============================================== --}}
    <nav class="navbar-glass sticky top-0 z-50 transition-all duration-300" id="main-navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">

                {{-- Logo / Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="relative w-9 h-9 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center shadow-lg group-hover:shadow-amber-500/40 transition-all duration-300 group-hover:scale-105">
                        <span class="text-lg leading-none">⛺</span>
                    </div>
                    <div class="hidden sm:block leading-tight text-white font-extrabold text-lg tracking-wide">
                        {{ $settings['web_name'] ?? 'Gedoy Camping Park' }}
                    </div>
                </a>

                {{-- Desktop Navigation Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Beranda</a>
                    <a href="{{ route('home') }}#paket" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Paket Wisata</a>
                    <a href="{{ route('home') }}#fasilitas" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Fasilitas</a>
                    <a href="{{ route('restaurant.index') }}" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Restoran</a>
                    <a href="{{ route('home') }}#tentang" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Tentang Kami</a>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}" target="_blank" class="nav-link text-white/80 hover:text-white text-sm font-medium transition-colors duration-200">Kontak</a>
                </div>

                {{-- Desktop Auth Actions --}}
                <div class="hidden md:flex items-center gap-4">

                    {{-- Cart Icon Button --}}
                    <a href="{{ route('cart.index') }}"
                       class="relative p-2 text-white/80 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-200 group"
                       title="Keranjang Belanja Restoran">
                        <span class="text-xl group-hover:scale-110 transition-transform duration-200 inline-block">🛒</span>
                        <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] h-[18px] flex items-center justify-center shadow-lg shadow-red-500/30 border border-red-600">
                            {{ $cartCount ?? 0 }}
                        </span>
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                           class="text-white/80 hover:text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}"
                           class="relative inline-flex items-center gap-1.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-gray-900 text-sm font-bold px-5 py-2.5 rounded-xl shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Daftar Gratis
                        </a>
                    @endguest

                    @auth
                        {{-- Profile Dropdown --}}
                        <div class="relative" id="profile-menu-wrapper">
                            <button
                                type="button"
                                id="profile-btn"
                                onclick="toggleProfileDropdown()"
                                class="flex items-center gap-2.5 bg-white/10 hover:bg-white/20 border border-white/20 hover:border-white/40 text-white px-3.5 py-2 rounded-xl text-sm font-semibold transition-all duration-200 group"
                                aria-expanded="false"
                                aria-haspopup="true">

                                {{-- Avatar initials --}}
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-gray-900 font-black text-xs shadow">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                </div>
                                <span class="hidden lg:inline max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                                <svg id="profile-chevron" class="w-3.5 h-3.5 text-white/60 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown Panel --}}
                            <div
                                id="profile-dropdown"
                                class="hidden dropdown-open absolute right-0 mt-3 w-64 origin-top-right rounded-2xl bg-white shadow-2xl shadow-black/20 ring-1 ring-black/5 overflow-hidden z-50">

                                {{-- User info header --}}
                                <div class="px-5 py-4 bg-gradient-to-br from-emerald-900 to-emerald-800">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-gray-900 font-black text-sm shadow-lg flex-shrink-0">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-white font-bold text-sm truncate">{{ Auth::user()->name }}</p>
                                            <p class="text-emerald-300 text-xs truncate">{{ Auth::user()->email }}</p>
                                            <span class="inline-flex mt-1 items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ Auth::user()->role === 'admin' ? 'bg-amber-400/20 text-amber-400' : 'bg-emerald-400/20 text-emerald-300' }}">
                                                {{ Auth::user()->role === 'admin' ? '👑 Admin' : '🌿 Member' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Menu Items --}}
                                <div class="py-1.5">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.index') }}"
                                           class="flex items-center gap-3 px-5 py-3 text-sm font-semibold text-emerald-700 hover:bg-emerald-50 transition-colors duration-150 group">
                                            <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-base group-hover:bg-emerald-200 transition-colors">📊</span>
                                            Dashboard Admin
                                        </a>
                                    @endif
                                    <a href="{{ route('user.dashboard') }}"
                                       class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-150 group">
                                        <span class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-base group-hover:bg-gray-200 transition-colors">👤</span>
                                        Profil Saya
                                    </a>
                                    <a href="{{ route('home') }}#paket"
                                       class="flex items-center gap-3 px-5 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-150 group">
                                        <span class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-base group-hover:bg-gray-200 transition-colors">⛺</span>
                                        Reservasi Baru
                                    </a>
                                </div>

                                <div class="border-t border-gray-100 py-1.5">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="flex items-center gap-3 w-full px-5 py-3 text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors duration-150 group">
                                            <span class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-base group-hover:bg-red-100 transition-colors">🚪</span>
                                            Keluar (Logout)
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>

                {{-- Mobile Hamburger Button --}}
                <button
                    type="button"
                    id="mobile-menu-btn"
                    onclick="toggleMobileMenu()"
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 transition-all duration-200"
                    aria-label="Toggle menu">
                    <div id="hamburger-icon" class="space-y-1.5">
                        <span class="block w-5 h-0.5 bg-white transition-all duration-300 origin-center" id="ham-1"></span>
                        <span class="block w-5 h-0.5 bg-white transition-all duration-300" id="ham-2"></span>
                        <span class="block w-5 h-0.5 bg-white transition-all duration-300 origin-center" id="ham-3"></span>
                    </div>
                </button>

            </div>
        </div>

        {{-- Mobile Menu Panel --}}
        <div id="mobile-menu"
             class="hidden md:hidden overflow-hidden border-t border-white/10"
             style="background: rgba(10, 25, 16, 0.96); backdrop-filter: blur(20px);">
            <div class="px-4 py-5 space-y-1">

                {{-- Mobile Nav Links --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">🏠</span> Beranda
                </a>
                <a href="{{ route('home') }}#paket" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">⛺</span> Paket Wisata
                </a>
                <a href="{{ route('home') }}#fasilitas" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">✨</span> Fasilitas
                </a>
                <a href="{{ route('restaurant.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">🍳</span> Restoran
                </a>
                <a href="{{ route('home') }}#tentang" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">ℹ️</span> Tentang Kami
                </a>
                <a href="https://wa.me/6281222099317" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <span class="text-base">💬</span> Kontak
                </a>
                <a href="{{ route('cart.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-medium transition-all duration-200">
                    <div class="flex items-center gap-3">
                        <span class="text-base">🛒</span> Keranjang
                    </div>
                    <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full min-w-[20px] text-center">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>

                {{-- Mobile Auth --}}
                <div class="pt-3 border-t border-white/10 mt-2">
                    @guest
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-white/90 hover:text-white hover:bg-white/10 text-sm font-semibold transition-all duration-200 w-full">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="mt-2 flex items-center justify-center gap-2 bg-gradient-to-r from-amber-400 to-amber-500 text-gray-900 text-sm font-bold px-4 py-3 rounded-xl shadow-lg shadow-amber-500/30 transition-all duration-300 w-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            Daftar Gratis
                        </a>
                    @endguest

                    @auth
                        {{-- Mobile user info --}}
                        <div class="flex items-center gap-3 px-4 py-3 mb-2 rounded-xl bg-white/5">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-gray-900 font-black text-sm flex-shrink-0">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-white font-bold text-sm truncate">{{ Auth::user()->name }}</p>
                                <p class="text-white/50 text-xs truncate">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-emerald-400 hover:bg-white/10 text-sm font-semibold transition-all duration-200">
                                📊 Dashboard Admin
                            </a>
                        @endif
                        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-white/80 hover:bg-white/10 text-sm font-medium transition-all duration-200">
                            👤 Profil Saya
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-1">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 text-sm font-semibold transition-all duration-200">
                                🚪 Keluar (Logout)
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- =============================================
         FLASH ALERTS
    ============================================== --}}
    @if (session('success'))
        <div id="flash-success"
             class="alert-enter fixed top-20 left-1/2 z-50 w-11/12 max-w-lg -translate-x-1/2 pointer-events-auto">
            <div class="flex items-center gap-4 bg-white border border-emerald-100 rounded-2xl shadow-2xl shadow-emerald-900/20 px-5 py-4">
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-lg">🎉</div>
                <p class="flex-1 text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                <button onclick="dismissAlert('flash-success')" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="mt-1 h-0.5 mx-5 bg-emerald-100 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="animation: shrink 5s linear forwards;"></div>
            </div>
        </div>
        <style>@keyframes shrink { from { width: 100%; } to { width: 0%; } }</style>
    @endif

    @if (session('error'))
        <div id="flash-error"
             class="alert-enter fixed top-20 left-1/2 z-50 w-11/12 max-w-lg -translate-x-1/2 pointer-events-auto">
            <div class="flex items-center gap-4 bg-white border border-red-100 rounded-2xl shadow-2xl shadow-red-900/20 px-5 py-4">
                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-lg">⚠️</div>
                <p class="flex-1 text-sm font-semibold text-red-800">{{ session('error') }}</p>
                <button onclick="dismissAlert('flash-error')" class="flex-shrink-0 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    {{-- =============================================
         MAIN CONTENT
    ============================================== --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- =============================================
         FOOTER – Multi-column premium design
    ============================================== --}}
    <footer class="footer-bg text-gray-400">

        {{-- Footer Top: Newsletter strip --}}
        <div class="border-b border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="font-serif-luxury text-2xl text-white mb-1">Dapatkan Info & Promo Terbaru</h3>
                        <p class="text-sm text-gray-500">Subscribe dan nikmati penawaran eksklusif via WhatsApp.</p>
                    </div>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}?text=Halo%20Gedoy%20Camping%2C%20saya%20ingin%20mendapatkan%20info%20promo%20terbaru"
                       target="_blank"
                       class="inline-flex items-center gap-2.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-gray-900 font-bold px-6 py-3 rounded-xl shadow-lg shadow-amber-500/20 transition-all duration-300 hover:-translate-y-0.5 text-sm whitespace-nowrap flex-shrink-0">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        Chat via WhatsApp
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer Main Grid --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

                {{-- Brand Column --}}
                <div class="sm:col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-lg shadow-lg">⛺</div>
                        <div class="text-white font-bold text-lg">
                            {{ $settings['web_name'] ?? 'Gedoy Camping Park' }}
                        </div>
                    </a>
                    <p class="text-sm text-gray-500 leading-relaxed mb-6">
                        Destinasi glamping premium di tepi sungai dan alam terbuka Ciater. Pengalaman alam yang tak terlupakan bersama orang-orang terkasih.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}" target="_blank"
                           class="w-9 h-9 rounded-lg bg-white/5 hover:bg-green-500/20 border border-white/10 flex items-center justify-center text-sm transition-all duration-200 hover:border-green-500/30 hover:text-green-400"
                           aria-label="WhatsApp">💬</a>
                        <a href="{{ $settings['instagram_url'] ?? 'https://www.instagram.com/' }}" target="_blank" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-pink-500/20 border border-white/10 flex items-center justify-center text-sm transition-all duration-200 hover:border-pink-500/30" aria-label="Instagram">📷</a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-blue-500/20 border border-white/10 flex items-center justify-center text-sm transition-all duration-200 hover:border-blue-500/30" aria-label="Facebook">👍</a>
                    </div>
                </div>

                {{-- Paket Column --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-5">Paket Wisata</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}#paket" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Paket Camping
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#paket" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Sewa Tempat
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('home') }}#fasilitas" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Fasilitas Umum
                            </a>
                        </li>
                        <li>
                            <a href="https://wa.me/6281222099317" target="_blank" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Paket Grup & Event
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Informasi Column --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-5">Informasi</h4>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}#tentang" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Tentang Kami
                            </a>
                        </li>
                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Masuk / Login
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Daftar Akun
                            </a>
                        </li>
                        @endguest
                        <li>
                            <a href="#" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Syarat & Ketentuan
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200 flex items-center gap-2">
                                <span class="w-1 h-1 rounded-full bg-amber-500/50"></span> Kebijakan Privasi
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Kontak Column --}}
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-widest mb-5">Hubungi Kami</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="text-amber-400 mt-0.5 flex-shrink-0">📍</span>
                            <span class="text-sm text-gray-500 leading-relaxed">{{ $settings['address'] ?? 'Kawasan Nagrak, Kecamatan Ciater, Kabupaten Subang' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 flex-shrink-0">📞</span>
                            <a href="tel:{{ $settings['tel_number'] ?? '+62 812-2209-9317' }}" class="text-sm text-gray-500 hover:text-amber-400 transition-colors duration-200">{{ $settings['tel_number'] ?? '+62 812-2209-9317' }}</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="text-amber-400 flex-shrink-0">🕐</span>
                            <span class="text-sm text-gray-500">Check-in: 14.00 – Check-out: 12.00</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="text-amber-400 mt-0.5 flex-shrink-0">🗓️</span>
                            <span class="text-sm text-gray-500">Buka setiap hari, Senin – Minggu</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        {{-- Footer Bottom Bar --}}
        <div class="border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-gray-600 text-center sm:text-left">
                    &copy; {{ date('Y') }} <span class="text-gray-500 font-semibold">{{ $settings['web_name'] ?? 'Gedoy Camping Park' }}</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-1.5">
                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs text-gray-600">Sistem aktif & siap melayani</span>
                </div>
            </div>
        </div>

    </footer>

    {{-- =============================================
         INLINE SCRIPTS – Navbar & UI interactions
    ============================================== --}}
    <script>
        // ---- Profile Dropdown ----
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profile-dropdown');
            const chevron  = document.getElementById('profile-chevron');
            const btn      = document.getElementById('profile-btn');
            const isHidden = dropdown.classList.contains('hidden');

            if (isHidden) {
                dropdown.classList.remove('hidden');
                dropdown.classList.add('dropdown-open');
                chevron && chevron.classList.add('rotate-180');
                btn && btn.setAttribute('aria-expanded', 'true');
            } else {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('dropdown-open');
                chevron && chevron.classList.remove('rotate-180');
                btn && btn.setAttribute('aria-expanded', 'false');
            }
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function (e) {
            const wrapper  = document.getElementById('profile-menu-wrapper');
            const dropdown = document.getElementById('profile-dropdown');
            const chevron  = document.getElementById('profile-chevron');
            const btn      = document.getElementById('profile-btn');
            if (wrapper && dropdown && !wrapper.contains(e.target)) {
                dropdown.classList.add('hidden');
                dropdown.classList.remove('dropdown-open');
                chevron && chevron.classList.remove('rotate-180');
                btn && btn.setAttribute('aria-expanded', 'false');
            }
        });

        // ---- Mobile Menu ----
        let mobileMenuOpen = false;
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const h1   = document.getElementById('ham-1');
            const h2   = document.getElementById('ham-2');
            const h3   = document.getElementById('ham-3');
            mobileMenuOpen = !mobileMenuOpen;

            if (mobileMenuOpen) {
                menu.classList.remove('hidden');
                menu.classList.add('mobile-menu-open');
                h1.style.transform = 'rotate(45deg) translateY(8px)';
                h2.style.opacity   = '0';
                h3.style.transform = 'rotate(-45deg) translateY(-8px)';
            } else {
                menu.classList.add('hidden');
                menu.classList.remove('mobile-menu-open');
                h1.style.transform = '';
                h2.style.opacity   = '1';
                h3.style.transform = '';
            }
        }

        // Close mobile menu on desktop resize
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768 && mobileMenuOpen) {
                toggleMobileMenu();
            }
        });

        // ---- Dismiss Alerts ----
        function dismissAlert(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateX(-50%) translateY(-10px)';
                el.style.transition = 'all 0.3s ease';
                setTimeout(() => el.remove(), 300);
            }
        }

        // Auto-dismiss success alert after 5s
        setTimeout(() => dismissAlert('flash-success'), 5000);

        // ---- Navbar scroll shadow ----
        const navbar = document.getElementById('main-navbar');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 10) {
                navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.4)';
            } else {
                navbar.style.boxShadow = 'none';
            }
        });
    </script>

    @stack('scripts')

</body>
</html>