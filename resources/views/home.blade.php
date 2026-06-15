@extends('layouts.app')

@section('title', 'Gedoy Camping Park – Glamping Premium di Tepi Sungai & Alam Terbuka Ciater')

@section('content')

@if(($settings['sys_status'] ?? 'open') === 'closed')
    <div class="bg-amber-500 text-slate-900 px-4 py-3.5 text-center font-bold text-sm z-50 relative flex items-center justify-center gap-2 shadow-md">
        <span>⚠️</span>
        <span>{{ $settings['sys_closed_message'] ?? 'Mohon maaf, Gedoy Camping Park sedang tutup sementara untuk pemeliharaan area kemah.' }}</span>
    </div>
@endif

{{-- ============================================================
     SECTION 1: HERO – Full-screen immersive with parallax
============================================================ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden" id="hero">

    {{-- Background layers --}}
    <div class="absolute inset-0 z-0">
        <img
            id="hero-bg"
            src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=1920&q=85"
            alt="Gedoy Camping Park – Alam Ciater"
            class="w-full h-full object-cover scale-110 transition-transform duration-300"
            loading="eager">
        {{-- Layered dark overlays for depth --}}
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/30 to-black/80"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/60 via-transparent to-emerald-950/40"></div>
    </div>

    {{-- Floating nature particles (decorative blobs) --}}
    <div class="absolute top-1/4 left-10 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-10 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Hero Content --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-16">
        <div class="max-w-4xl mx-auto text-center">

            {{-- Premium Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-8 animate-fade-in">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                Premium Glamping Experience · Ciater, Subang
            </div>

            {{-- Main Heading --}}
            <h1 class="font-serif-luxury text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold text-white leading-[1.05] tracking-tight mb-6">
                Selamat Datang di<br>
                <span class="relative inline-block">
                    <span class="text-gold-gradient">
                        Gedoy Camping
                    </span>
                    {{-- Decorative underline --}}
                    <svg class="absolute -bottom-2 left-0 w-full" height="6" viewBox="0 0 300 6" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                        <path d="M0 3 Q75 0 150 3 Q225 6 300 3" stroke="url(#gold-grad)" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                        <defs>
                            <linearGradient id="gold-grad" x1="0" y1="0" x2="300" y2="0" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#d4a843" stop-opacity="0"/>
                                <stop offset="50%" stop-color="#f0c96a"/>
                                <stop offset="100%" stop-color="#d4a843" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                    </svg>
                </span>
                <span class="text-white"> Park</span>
            </h1>

            {{-- Subheadline --}}
            <p class="text-base sm:text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed font-light">
                Nikmati ketenangan tepi sungai &amp; asrinya alam terbuka di
                <span class="text-amber-300 font-medium">{{ $settings['address'] ?? 'Kawasan Nagrak, Kecamatan Ciater, Kabupaten Subang' }}</span>.
                Hanya 15 menit dari pusat wisata Ciater, jauh dari kebisingan kota.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16">
                <a href="#paket"
                   class="group relative inline-flex items-center gap-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-gray-900 font-bold text-base sm:text-lg px-8 py-4 rounded-2xl shadow-2xl shadow-amber-500/30 hover:shadow-amber-500/50 transition-all duration-300 hover:-translate-y-1 active:translate-y-0 overflow-hidden">
                    <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 rounded-2xl"></span>
                    <svg class="relative w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="relative">Reservasi Sekarang</span>
                </a>

                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/30 hover:border-white/50 text-white font-semibold text-base sm:text-lg px-8 py-4 rounded-2xl transition-all duration-300 hover:-translate-y-1">
                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.521.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.521-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    <span class="relative">Hubungi Admin</span>
                </a>
            </div>

            {{-- Floating Stats Row --}}
            <div class="flex flex-wrap justify-center gap-4 sm:gap-8">
                @foreach([
                    ['num' => '500+',  'label' => 'Tamu Puas', 'icon' => '😊'],
                    ['num' => '2',     'label' => 'Area Eksklusif', 'icon' => '⛺'],
                    ['num' => '4.9★',  'label' => 'Rating Google', 'icon' => '⭐'],
                    ['num' => '24/7',  'label' => 'Dukungan Admin', 'icon' => '🛎️'],
                ] as $stat)
                <div class="flex items-center gap-3 bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl px-5 py-3">
                    <span class="text-2xl">{{ $stat['icon'] }}</span>
                    <div class="text-left">
                        <p class="text-white font-extrabold text-lg leading-tight">{{ $stat['num'] }}</p>
                        <p class="text-gray-400 text-xs font-medium">{{ $stat['label'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 animate-bounce">
        <span class="text-white/40 text-xs font-medium tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>


{{-- ============================================================
     SECTION 2: TRUST BAR – Logos / highlights strip
============================================================ --}}
<section class="bg-white border-b border-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-6 sm:gap-10 md:gap-16">
            @foreach([
                ['icon' => '🏆', 'text' => 'Best Nature Camp Jabar 2024'],
                ['icon' => '🌿', 'text' => 'Eco-Friendly Certified'],
                ['icon' => '🔒', 'text' => 'Pembayaran 100% Aman'],
                ['icon' => '↩️', 'text' => 'Garansi Kepuasan Tamu'],
                ['icon' => '📍', 'text' => '15 Menit dari Ciater'],
            ] as $item)
            <div class="flex items-center gap-2.5 text-gray-600">
                <span class="text-xl">{{ $item['icon'] }}</span>
                <span class="text-sm font-semibold whitespace-nowrap">{{ $item['text'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 3: ABOUT US – Split layout with image mosaic
============================================================ --}}
<section id="tentang" class="py-24 lg:py-32 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20 items-center">

            {{-- Left: Image Mosaic --}}
            <div class="relative" data-reveal="left">
                <div class="grid grid-cols-2 gap-4">
                    {{-- Main large image --}}
                    <div class="col-span-2 sm:col-span-1 row-span-2">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl shadow-emerald-900/20 h-64 sm:h-80 lg:h-96 group">
                            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=800&q=80"
                                 alt="River Camp Gedoy"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 bg-white/10 backdrop-blur-md border border-white/20 text-white px-3 py-1.5 rounded-xl text-xs font-bold">
                                🏞 River Camp Area
                            </div>
                        </div>
                    </div>

                    {{-- Top-right image --}}
                    <div class="rounded-2xl overflow-hidden shadow-xl h-36 sm:h-44 group">
                        <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=600&q=80"
                             alt="Sewa Tempat Gedoy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>

                    {{-- Bottom-right image --}}
                    <div class="rounded-2xl overflow-hidden shadow-xl h-36 sm:h-44 group">
                        <img src="https://images.unsplash.com/photo-1445307806294-bff7f67ff225?auto=format&fit=crop&w=600&q=80"
                             alt="Suasana Malam Gedoy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                </div>

                {{-- Floating badge --}}
                <div class="absolute -bottom-6 -right-4 sm:-right-8 bg-gradient-to-br from-amber-400 to-amber-600 text-gray-900 rounded-2xl shadow-2xl shadow-amber-500/30 p-5 flex items-center gap-3">
                    <span class="text-3xl">🌲</span>
                    <div>
                        <p class="font-black text-2xl leading-tight">5+</p>
                        <p class="text-xs font-bold leading-tight opacity-80">Tahun<br>Beroperasi</p>
                    </div>
                </div>
            </div>

            {{-- Right: Content --}}
            <div data-reveal="right">
                {{-- Section label --}}
                <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Tentang Kami
                </div>

                <h2 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Alam Terbaik<br>
                    untuk <span class="text-emerald-700">Kenangan</span><br>
                    <span class="text-gold-gradient">Tak Terlupakan</span>
                </h2>

                <p class="text-gray-600 text-base leading-relaxed mb-5">
                    {{ $settings['web_name'] ?? 'Gedoy Camping Park' }} hadir sebagai destinasi glamping premium di {{ $settings['address'] ?? 'Kawasan Nagrak, Kecamatan Ciater, Kabupaten Subang' }}. Didirikan dengan semangat menciptakan pengalaman alam yang autentik namun tetap nyaman.
                </p>
                <p class="text-gray-600 text-base leading-relaxed mb-8">
                    Kami menawarkan dua area eksklusif — <strong class="text-emerald-700">Paket Camping</strong> di tepi sungai yang menenangkan, dan <strong class="text-emerald-700">Sewa Tempat</strong> di area terbuka yang asri. Setiap sudut dirancang untuk menyatu harmonis dengan alam.
                </p>

                {{-- Feature list --}}
                <div class="space-y-3 mb-10">
                    @foreach([
                        'Lokasi strategis 15 menit dari Ciater Hotspring',
                        'Fasilitas lengkap: parkir, toilet bersih, musala, & sewa peralatan',
                        'Pemandangan sungai & alam terbuka yang memukau',
                        'Tim pengelola profesional & responsif 24 jam',
                        'Cocok untuk keluarga, komunitas, hingga team building',
                    ] as $feat)
                    <div class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-5 h-5 rounded-full bg-emerald-100 flex items-center justify-center mt-0.5">
                            <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 text-sm font-medium">{{ $feat }}</span>
                    </div>
                    @endforeach
                </div>

                <a href="#paket"
                   class="inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-lg shadow-emerald-900/30 transition-all duration-300 hover:-translate-y-0.5 text-sm">
                    Lihat Paket Kami
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 4: EXPERIENCE NUMBERS – Dark with counter animation
============================================================ --}}
<section class="py-20 relative overflow-hidden" style="background: linear-gradient(135deg, #0a1f12 0%, #0f2a1a 50%, #091810 100%);">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-emerald-900/40 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-amber-900/20 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-4">
            @foreach([
                ['value' => '500', 'suffix' => '+', 'label' => 'Tamu Puas', 'sub' => 'sejak 2019', 'icon' => '😊'],
                ['value' => '2',   'suffix' => '',  'label' => 'Area Camping',  'sub' => 'Sungai & Darat', 'icon' => '⛺'],
                ['value' => '4.9', 'suffix' => '★', 'label' => 'Rating Kami', 'sub' => 'di Google Maps', 'icon' => '⭐'],
                ['value' => '15',  'suffix' => '',  'label' => 'Menit Ciater', 'sub' => 'dari pusat kota', 'icon' => '📍'],
            ] as $stat)
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white/5 border border-white/10 text-2xl mb-4 group-hover:bg-amber-500/10 group-hover:border-amber-500/30 transition-all duration-300">
                    {{ $stat['icon'] }}
                </div>
                <div class="font-serif-luxury text-4xl sm:text-5xl font-bold text-white mb-1">
                    {{ $stat['value'] }}<span class="text-amber-400">{{ $stat['suffix'] }}</span>
                </div>
                <p class="text-white font-semibold text-sm sm:text-base mb-1">{{ $stat['label'] }}</p>
                <p class="text-gray-500 text-xs">{{ $stat['sub'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 5: PACKAGES – Premium cards with hover reveal
============================================================ --}}
<section id="paket" class="py-24 lg:py-32" style="background: #f8f7f4;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-16 lg:mb-20">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Pilihan Paket
            </div>
            <h2 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-5">
                Temukan <span class="text-emerald-700">Pengalaman</span><br>
                yang Tepat untuk Anda
            </h2>
            <p class="text-gray-500 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                Tersedia dua area eksklusif yang dirancang khusus untuk kenyamanan dan ketenangan Anda menyatu dengan alam.
            </p>
        </div>

        {{-- Package Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 max-w-7xl mx-auto">
            @foreach($packages as $index => $package)

            {{-- Determine package-specific assets --}}
            @php
                if ($package->image_path) {
                    $imgUrl = asset('storage/' . $package->image_path);
                    $badge = ($package->icon ?? '⛺') . ' ' . $package->name;
                    $accentFrom = '#064e3b';
                    $tag = 'Nature Escape';
                    $tagColor = 'bg-emerald-600 text-white';
                } elseif ($package->slug === 'river-camp') {
                    $imgUrl = 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=900&q=85';
                    $badge = '🏞 Tepi Sungai';
                    $accentFrom = '#0f4c35';
                    $tag = 'Paling Populer';
                    $tagColor = 'bg-amber-400 text-gray-900';
                } elseif ($package->slug === 'kabin-kayu') {
                    $imgUrl = asset('images/kabin-kayu.png');
                    $badge = '🏡 Kabin Kayu';
                    $accentFrom = '#4a2c11';
                    $tag = 'Premium Executive';
                    $tagColor = 'bg-emerald-600 text-white';
                } else {
                    $imgUrl = 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=900&q=85';
                    $badge = '🏕️ Area Camping';
                    $accentFrom = '#1a3a2a';
                    $tag = 'Nature Escape';
                    $tagColor = 'bg-emerald-650 text-white';
                }
            @endphp

            <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl shadow-black/8 hover:shadow-2xl hover:shadow-emerald-900/20 transition-all duration-500 hover:-translate-y-2 flex flex-col">

                {{-- Image Area --}}
                <div class="relative h-64 sm:h-72 overflow-hidden">
                    <img src="{{ $imgUrl }}"
                         alt="{{ $package->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">

                    {{-- Image overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>

                    {{-- Top badges --}}
                    <div class="absolute top-4 left-4 right-4 flex items-start justify-between">
                        <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            {{ $badge }}
                        </span>
                        <span class="inline-flex items-center {{ $tagColor }} text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                            {{ $tag }}
                        </span>
                    </div>

                    {{-- Bottom image overlay: price preview --}}
                    <div class="absolute bottom-4 left-4">
                        <p class="text-white/70 text-xs font-medium mb-0.5">Mulai dari</p>
                        <p class="text-white font-black text-2xl leading-none">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                            <span class="text-white/70 font-normal text-sm">/malam</span>
                        </p>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="flex-1 flex flex-col p-7">
                    {{-- Title & Rating --}}
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            <h3 class="text-xl sm:text-2xl font-black text-gray-900 tracking-tight mb-1">
                                {{ $package->name }}
                            </h3>
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3.5 h-3.5 {{ $i <= 5 ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endfor
                                <span class="text-gray-400 text-xs ml-1 font-medium">4.9 (50 ulasan)</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 text-3xl mt-1">{{ $package->slug === 'river-camp' ? '🏞' : ($package->slug === 'kabin-kayu' ? '🏡' : '🏕️') }}</div>
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        {{ $package->description }}
                    </p>

                    {{-- Feature Tags --}}
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($package->features as $feature)
                            <span class="inline-flex items-center gap-1 bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-full font-semibold">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ $feature }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-100 mt-auto pt-5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-gray-400 text-xs">Harga per malam</p>
                                <p class="text-gray-900 font-extrabold text-xl">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </p>
                            </div>
                            <a href="{{ route('booking.show', $package->slug) }}"
                               class="group/btn relative inline-flex items-center gap-2 bg-emerald-800 hover:bg-emerald-700 text-white font-bold text-sm px-6 py-3.5 rounded-2xl shadow-lg shadow-emerald-900/30 hover:shadow-emerald-700/40 transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                                <span class="absolute inset-0 bg-gradient-to-r from-amber-500/0 to-amber-500/0 group-hover/btn:from-amber-500/10 group-hover/btn:to-transparent transition-all duration-300"></span>
                                <span class="relative">Pilih Paket</span>
                                <svg class="relative w-4 h-4 group-hover/btn:translate-x-0.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        {{-- Comparison note --}}
        <p class="text-center text-gray-400 text-sm mt-10">
            💡 <span class="font-medium text-gray-500">Belum yakin?</span>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-semibold underline underline-offset-2 transition-colors">
                Chat admin kami
            </a>
            untuk rekomendasi terbaik.
        </p>
    </div>
</section>


{{-- ============================================================
     SECTION 6: FACILITIES – Premium icon grid
============================================================ --}}
<section id="fasilitas" class="py-24 lg:py-32 relative overflow-hidden" style="background: linear-gradient(160deg, #0a1f12 0%, #0f2a1a 60%, #091810 100%);">

    {{-- Decorative elements --}}
    <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-emerald-500/30 to-transparent"></div>
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-20 right-10 w-72 h-72 bg-emerald-800/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 left-10 w-96 h-96 bg-amber-900/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 bg-white/5 border border-white/10 text-emerald-400 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                Fasilitas Kami
            </div>
            <h2 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-white mb-5">
                Semua yang Anda<br>
                Butuhkan Tersedia
            </h2>
            <p class="text-gray-400 text-base sm:text-lg max-w-xl mx-auto leading-relaxed">
                Kami menyediakan fasilitas lengkap agar pengalaman glamping Anda nyaman, aman, dan tak terlupakan.
            </p>
        </div>

        {{-- Facilities Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 lg:gap-6">
            @foreach([
                ['icon' => '🅿️', 'title' => 'Area Parkir Luas',    'desc' => 'Kapasitas 50+ kendaraan, aman & dijaga'],
                ['icon' => '🚿', 'title' => 'Kamar Mandi Bersih',  'desc' => 'Toilet & shower air panas tersedia'],
                ['icon' => '🕌', 'title' => 'Musala',              'desc' => 'Fasilitas ibadah bersih & nyaman'],
                ['icon' => '⛺', 'title' => 'Sewa Tenda & Matras', 'desc' => 'Peralatan camping lengkap tersedia'],
                ['icon' => '🔥', 'title' => 'Area Bonfire',        'desc' => 'Titik api unggun yang sudah terstruktur'],
                ['icon' => '🍳', 'title' => 'Area Memasak',        'desc' => 'Dapur umum lengkap dengan peralatan'],
                ['icon' => '🌊', 'title' => 'Akses Sungai',        'desc' => 'Tepi sungai Ciater yang jernih & segar'],
                ['icon' => '💡', 'title' => 'Listrik 24 Jam',      'desc' => 'Generator backup untuk kebutuhan Anda'],
                ['icon' => '🗑️', 'title' => 'Pengelolaan Sampah',  'desc' => 'Area wisata bersih & ramah lingkungan'],
                ['icon' => '🏕️', 'title' => 'Spot Foto Instagramable', 'desc' => 'Spot foto alam terbaik di setiap sudut'],
                ['icon' => '🛡️', 'title' => 'Keamanan 24 Jam',    'desc' => 'Petugas keamanan siap sepanjang waktu'],
                ['icon' => '📶', 'title' => 'Area Sinyal Baik',    'desc' => 'Konektivitas memadai di sekitar camp'],
            ] as $fac)
            <div class="group bg-white/5 hover:bg-white/10 border border-white/8 hover:border-white/20 rounded-2xl p-5 transition-all duration-300 hover:-translate-y-1 cursor-default">
                <div class="w-12 h-12 rounded-xl bg-emerald-900/60 border border-emerald-700/40 flex items-center justify-center text-2xl mb-4 group-hover:bg-emerald-800/60 transition-colors duration-300">
                    {{ $fac['icon'] }}
                </div>
                <h3 class="text-white font-bold text-sm mb-1.5">{{ $fac['title'] }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $fac['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 7: GALLERY PREVIEW – Masonry-style image grid
============================================================ --}}
<section class="py-24 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                Galeri
            </div>
            <h2 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Keindahan <span class="text-emerald-700">Gedoy Camping</span>
            </h2>
            <p class="text-gray-500 text-base max-w-xl mx-auto">
                Setiap sudut menyimpan cerita dan keindahan alam yang menunggu untuk Anda abadikan.
            </p>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 auto-rows-[180px]">
            @php
                $spans = [
                    0 => 'col-span-2 row-span-2',
                    1 => 'col-span-1 row-span-1',
                    2 => 'col-span-1 row-span-1',
                    3 => 'col-span-1 row-span-2',
                    4 => 'col-span-1 row-span-1',
                    5 => 'col-span-1 row-span-1',
                    6 => 'col-span-1 row-span-1',
                ];
                
                $galleryItems = [
                    ['url' => 'https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=800&q=80',  'span' => 'col-span-2 row-span-2', 'alt' => 'Hero Shot Camping'],
                    ['url' => 'https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-1', 'alt' => 'River Camp'],
                    ['url' => 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-1', 'alt' => 'Sewa Tempat'],
                    ['url' => 'https://images.unsplash.com/photo-1445307806294-bff7f67ff225?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-2', 'alt' => 'Bonfire Night'],
                    ['url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-1', 'alt' => 'Alam Sejuk'],
                    ['url' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-1', 'alt' => 'Sungai Ciater'],
                    ['url' => 'https://images.unsplash.com/photo-1537905569824-f89f14cceb68?auto=format&fit=crop&w=600&q=80',  'span' => 'col-span-1 row-span-1', 'alt' => 'Pagi Berkabut'],
                ];
            @endphp

            @if(isset($galleryImages) && $galleryImages->isNotEmpty())
                @foreach($galleryImages as $i => $img)
                    @php
                        $span = $spans[$i % 7] ?? 'col-span-1 row-span-1';
                    @endphp
                    <div class="{{ $span }} relative group rounded-2xl overflow-hidden shadow-lg cursor-pointer">
                        <img src="{{ Storage::url($img->path) }}" alt="{{ $img->original_name ?? 'Foto Galeri' }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl px-3 py-2">
                                <span class="text-white text-xs font-semibold">{{ $img->original_name ?? 'Foto Galeri' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($galleryItems as $i => $img)
                    <div class="{{ $img['span'] }} relative group rounded-2xl overflow-hidden shadow-lg cursor-pointer">
                        <img src="{{ $img['url'] }}" alt="{{ $img['alt'] }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl px-3 py-2">
                                <span class="text-white text-xs font-semibold">{{ $img['alt'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="text-center mt-10">
            <a href="{{ $settings['instagram_url'] ?? 'https://www.instagram.com/' }}" target="_blank"
               class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-pink-500 hover:from-purple-700 hover:to-pink-600 text-white font-bold px-7 py-3.5 rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-0.5 text-sm">
                📷 Lihat Lebih Banyak di Instagram
            </a>
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 8: TESTIMONIALS – Quotes carousel
============================================================ --}}
<section class="py-24 lg:py-32" style="background: #f8f7f4;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                Ulasan Tamu
            </div>
            <h2 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Apa Kata Tamu Kami?
            </h2>
            <p class="text-gray-500 text-base max-w-xl mx-auto">
                Ribuan keluarga dan komunitas telah merasakan pengalaman luar biasa bersama Gedoy Camping Park.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                [
                    'name'   => 'Reza Firmansyah',
                    'role'   => 'Family Trip · Paket Camping',
                    'rating' => 5,
                    'text'   => 'Pengalaman yang luar biasa! Anak-anak sangat senang bermain di tepi sungai. Fasilitas bersih dan pengelolanya sangat ramah. Pasti akan kembali lagi!',
                    'avatar' => 'RF',
                    'date'   => 'November 2024',
                ],
                [
                    'name'   => 'Siti Amalia Putri',
                    'role'   => 'Honeymoon · Sewa Tempat',
                    'rating' => 5,
                    'text'   => 'Romantis banget! Suasana alam terbuka di malam hari dengan bintang bertaburan sangat memukau. Kami sangat merekomendasikan untuk pasangan.',
                    'avatar' => 'SA',
                    'date'   => 'Desember 2024',
                ],
                [
                    'name'   => 'Komunitas Alam Bandung',
                    'role'   => 'Group Event · 40 Peserta',
                    'rating' => 5,
                    'text'   => 'Gedoy adalah tempat terbaik untuk acara komunitas! Area luas, akses mudah, dan tim pengelola sangat membantu dari persiapan hingga acara selesai.',
                    'avatar' => 'KA',
                    'date'   => 'Januari 2025',
                ],
            ] as $review)
            <div class="bg-white rounded-3xl p-7 shadow-lg shadow-black/5 border border-gray-100 hover:shadow-xl hover:shadow-emerald-900/8 transition-all duration-300 hover:-translate-y-1 flex flex-col">
                {{-- Stars --}}
                <div class="flex gap-1 mb-5">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $review['rating'] ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                </div>

                {{-- Quote --}}
                <div class="relative mb-6 flex-1">
                    <svg class="absolute -top-2 -left-1 w-8 h-8 text-emerald-100" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                    </svg>
                    <p class="text-gray-600 text-sm leading-relaxed pl-5">
                        {{ $review['text'] }}
                    </p>
                </div>

                {{-- Reviewer --}}
                <div class="flex items-center gap-3 pt-5 border-t border-gray-100">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-600 to-emerald-800 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                        {{ $review['avatar'] }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-gray-900 font-bold text-sm truncate">{{ $review['name'] }}</p>
                        <p class="text-gray-400 text-xs truncate">{{ $review['role'] }} · {{ $review['date'] }}</p>
                    </div>
                    <div class="ml-auto flex-shrink-0">
                        <span class="bg-emerald-50 text-emerald-600 text-xs font-bold px-2.5 py-1 rounded-full">✓ Terverifikasi</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 9: HOW TO BOOK – Step process
============================================================ --}}
<section class="py-24 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                Cara Reservasi
            </div>
            <h2 class="font-serif-luxury text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                Mudah & Cepat dalam<br>
                <span class="text-emerald-700">4 Langkah</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            {{-- Connecting line (desktop) --}}
            <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-px bg-gradient-to-r from-emerald-100 via-emerald-300 to-emerald-100 z-0"></div>

            @foreach([
                ['step' => '01', 'icon' => '🔍', 'title' => 'Pilih Paket', 'desc' => 'Jelajahi Paket Camping atau Sewa Tempat dan temukan yang paling sesuai.'],
                ['step' => '02', 'icon' => '📋', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data diri, tanggal check-in/out, dan jumlah tamu.'],
                ['step' => '03', 'icon' => '✅', 'title' => 'Konfirmasi Admin', 'desc' => 'Tim kami akan memverifikasi dan mengkonfirmasi reservasi Anda.'],
                ['step' => '04', 'icon' => '⛺', 'title' => 'Nikmati Alam!', 'desc' => 'Datang, check-in, dan nikmati pengalaman glamping terbaik.'],
            ] as $step)
            <div class="relative z-10 text-center flex flex-col items-center">
                <div class="relative mb-5">
                    <div class="w-20 h-20 rounded-2xl bg-white border-2 border-emerald-100 shadow-xl shadow-emerald-900/10 flex items-center justify-center text-3xl mb-1 group-hover:border-emerald-400 transition-colors">
                        {{ $step['icon'] }}
                    </div>
                    <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-emerald-700 text-white text-xs font-black flex items-center justify-center shadow-md">
                        {{ $step['step'] }}
                    </span>
                </div>
                <h3 class="text-gray-900 font-bold text-base mb-2">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed max-w-[180px]">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 10: CTA BANNER – Final call to action
============================================================ --}}
<section class="relative py-24 overflow-hidden">
    {{-- Background --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1533873984035-25970ab07461?auto=format&fit=crop&w=1920&q=80"
             alt="Call to Action Background"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/95 via-emerald-950/80 to-emerald-950/60"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block text-5xl mb-6">⛺</span>
        <h2 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
            Siap Merasakan<br>
            <span class="text-gold-gradient">
                Petualangan Alam?
            </span>
        </h2>
        <p class="text-gray-300 text-base sm:text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
            Jangan tunda lagi. Ribuan tamu sudah merasakan keajaiban Gedoy Camping Park. Giliran Anda menciptakan kenangan indah bersama orang-orang tersayang.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#paket"
               class="inline-flex items-center gap-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-gray-900 font-bold text-lg px-10 py-4 rounded-2xl shadow-2xl shadow-amber-500/30 hover:shadow-amber-500/50 transition-all duration-300 hover:-translate-y-1">
                🎯 Reservasi Sekarang
            </a>
            <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281222099317' }}?text=Halo%20Gedoy%20Camping%2C%20saya%20ingin%20bertanya%20tentang%20paket%20camping"
               target="_blank"
               class="inline-flex items-center gap-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/30 text-white font-semibold text-lg px-10 py-4 rounded-2xl transition-all duration-300 hover:-translate-y-1">
                💬 Tanya via WhatsApp
            </a>
        </div>

        {{-- Micro trust --}}
        <div class="flex flex-wrap items-center justify-center gap-5 mt-10">
            @foreach(['✓ Tanpa biaya tersembunyi', '✓ Konfirmasi cepat', '✓ Bisa reschedule'] as $trust)
            <span class="text-emerald-300 text-sm font-medium">{{ $trust }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- Page-specific styles --}}
<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.8s ease-out forwards; }

    /* Scroll reveal: handled via IntersectionObserver below */
    [data-reveal] { opacity: 0; transform: translateY(30px); transition: opacity 0.7s ease, transform 0.7s ease; }
    [data-reveal="left"] { transform: translateX(-30px); }
    [data-reveal="right"] { transform: translateX(30px); }
    [data-reveal].revealed { opacity: 1; transform: translate(0, 0); }
</style>

@push('scripts')
<script>
    // ---- Parallax on Hero BG ----
    const heroBg = document.getElementById('hero-bg');
    if (heroBg) {
        window.addEventListener('scroll', function () {
            const offset = window.scrollY;
            heroBg.style.transform = `scale(1.1) translateY(${offset * 0.3}px)`;
        }, { passive: true });
    }

    // ---- Scroll Reveal ----
    const revealEls = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('revealed'));
    }
</script>
@endpush

@endsection