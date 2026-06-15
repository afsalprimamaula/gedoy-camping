@extends('layouts.app')

@section('title', 'Reservasi ' . $package->name . ' – Gedoy Camping Park')

@section('content')

{{-- ============================================================
     BACKGROUND LAYER – Subtle nature texture
============================================================ --}}
<div class="min-h-screen relative" style="background: linear-gradient(145deg, #f0f4f0 0%, #f8f7f4 40%, #f0f4ee 100%);">

    {{-- Decorative blobs --}}
    <div class="fixed top-0 right-0 w-[600px] h-[600px] rounded-full pointer-events-none opacity-30"
         style="background: radial-gradient(circle, rgba(74,124,89,0.15) 0%, transparent 70%); transform: translate(30%, -30%);"></div>
    <div class="fixed bottom-0 left-0 w-[500px] h-[500px] rounded-full pointer-events-none opacity-20"
         style="background: radial-gradient(circle, rgba(212,168,67,0.12) 0%, transparent 70%); transform: translate(-30%, 30%);"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">

        {{-- ── Breadcrumb / Back Nav ─────────────────────────────── --}}
        <nav class="flex items-center gap-2 text-sm mb-8" aria-label="Breadcrumb">
            <a href="{{ route('home') }}"
               class="flex items-center gap-1.5 text-gray-500 hover:text-emerald-700 font-medium transition-colors duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda
            </a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-400 font-medium">Paket Wisata</span>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-emerald-700 font-semibold">{{ $package->name }}</span>
        </nav>

        {{-- ── Booking Flash Error (Double-booking) ─────────────── --}}
        @if(session('error'))
        <div class="mb-6 flex items-start gap-4 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl shadow-sm">
            <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-lg">🚫</div>
            <div>
                <p class="font-bold text-sm">Tanggal Tidak Tersedia</p>
                <p class="text-sm mt-0.5 text-red-600">{{ session('error') }}</p>
            </div>
        </div>
        @endif

        {{-- ── MAIN SPLIT LAYOUT ─────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8 items-start">

            {{-- ══════════════════════════════════════
                 LEFT PANEL – Package Summary (2/5)
            ══════════════════════════════════════ --}}
            <aside class="lg:col-span-2 lg:sticky lg:top-24">

                {{-- Package Hero Card --}}
                <div class="rounded-3xl overflow-hidden shadow-2xl shadow-emerald-900/20 mb-5">

                    {{-- Image --}}
                    <div class="relative h-52 sm:h-64 overflow-hidden">
                        @if($package->image_path)
                            <img src="{{ asset('storage/' . $package->image_path) }}"
                                 alt="{{ $package->name }}"
                                 class="w-full h-full object-cover">
                        @elseif($package->slug === 'river-camp')
                            <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=800&q=85"
                                 alt="{{ $package->name }}"
                                 class="w-full h-full object-cover">
                        @elseif($package->slug === 'kabin-kayu')
                            <img src="{{ asset('images/kabin-kayu.png') }}"
                                 alt="{{ $package->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=800&q=85"
                                 alt="{{ $package->name }}"
                                 class="w-full h-full object-cover">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>

                        {{-- Package type badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center gap-1.5 bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                {{ $package->slug === 'river-camp' ? '🏞 ' . $package->name : ($package->slug === 'kabin-kayu' ? '🏡 ' . $package->name : '🏕️ ' . $package->name) }}
                            </span>
                        </div>

                        {{-- Price overlay --}}
                        <div class="absolute bottom-4 left-4 right-4 flex items-end justify-between">
                            <div>
                                <h2 class="text-white font-black text-2xl leading-tight drop-shadow-lg">
                                    {{ $package->name }}
                                </h2>
                                <p class="text-white/70 text-xs mt-0.5">Ciater, Subang, Jawa Barat</p>
                            </div>
                            <div class="text-right flex-shrink-0 ml-3">
                                <p class="text-white/60 text-xs">per malam</p>
                                <p class="text-amber-400 font-black text-xl leading-tight">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Dark info panel --}}
                    <div style="background: linear-gradient(160deg, #0f2a1a, #0a1f12);" class="p-6">

                        {{-- Description --}}
                        <p class="text-gray-400 text-sm leading-relaxed mb-5">
                            {{ $package->description }}
                        </p>

                        {{-- Key stats --}}
                        <div class="grid grid-cols-2 gap-3 mb-5">
                            <div class="bg-white/5 border border-white/8 rounded-2xl p-3.5 text-center">
                                <p class="text-2xl mb-1">👥</p>
                                <p class="text-white font-bold text-sm">Maks. {{ $package->capacity }}</p>
                                <p class="text-gray-500 text-xs">Orang</p>
                            </div>
                            <div class="bg-white/5 border border-white/8 rounded-2xl p-3.5 text-center">
                                <p class="text-2xl mb-1">🕐</p>
                                <p class="text-white font-bold text-sm">14.00</p>
                                <p class="text-gray-500 text-xs">Check-in</p>
                            </div>
                            <div class="bg-white/5 border border-white/8 rounded-2xl p-3.5 text-center">
                                <p class="text-2xl mb-1">⭐</p>
                                <p class="text-white font-bold text-sm">4.9 / 5.0</p>
                                <p class="text-gray-500 text-xs">Rating</p>
                            </div>
                            <div class="bg-white/5 border border-white/8 rounded-2xl p-3.5 text-center">
                                <p class="text-2xl mb-1">📍</p>
                                <p class="text-white font-bold text-sm">15 Menit</p>
                                <p class="text-gray-500 text-xs">Dari Ciater</p>
                            </div>
                        </div>

                        {{-- Features list --}}
                        <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">Termasuk dalam Paket</p>
                        <div class="space-y-2 mb-5">
                            @foreach($package->features as $feature)
                            <div class="flex items-center gap-2.5">
                                <div class="w-4 h-4 rounded-full bg-emerald-700/50 border border-emerald-600/50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-2.5 h-2.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="text-gray-300 text-xs font-medium">{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Info disclaimer --}}
                        <div class="bg-amber-500/10 border border-amber-500/20 rounded-2xl p-4">
                            <div class="flex items-start gap-3">
                                <span class="text-amber-400 flex-shrink-0 mt-0.5">💡</span>
                                <p class="text-amber-200/80 text-xs leading-relaxed">
                                    Tim kami akan menghubungi Anda via WhatsApp untuk konfirmasi dan informasi pembayaran setelah pesanan dikirim.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Price Estimator (live JS update) --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-lg p-5" id="price-estimator">
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest mb-4">Estimasi Biaya</p>
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Harga per malam</span>
                            <span class="text-gray-800 font-semibold text-sm">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Durasi menginap</span>
                            <span id="est-nights" class="text-gray-800 font-semibold text-sm">– malam</span>
                        </div>
                        <div class="border-t border-gray-100 pt-2.5 flex items-center justify-between">
                            <span class="text-gray-700 font-bold text-sm">Total Estimasi</span>
                            <span id="est-total" class="text-emerald-700 font-black text-lg">–</span>
                        </div>
                    </div>
                    <p class="text-gray-400 text-xs mt-3 leading-relaxed">
                        * Harga final dikonfirmasi oleh admin. Tidak termasuk biaya sewa peralatan tambahan.
                    </p>
                </div>
            </aside>


            {{-- ══════════════════════════════════════
                 RIGHT PANEL – Booking Form (3/5)
            ══════════════════════════════════════ --}}
            <main class="lg:col-span-3">
                <div class="bg-white rounded-3xl shadow-xl shadow-black/8 border border-gray-100 overflow-hidden">

                    {{-- Form Header --}}
                    <div class="px-7 pt-8 pb-0">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-gray-900">Lengkapi Data Pesanan</h1>
                                <p class="text-gray-400 text-sm">Isi formulir di bawah dengan data yang valid</p>
                            </div>
                        </div>

                        {{-- Progress indicator --}}
                        <div class="flex items-center gap-2 mt-6 mb-7">
                            <div class="flex items-center gap-1.5">
                                <div class="w-6 h-6 rounded-full bg-emerald-700 text-white text-xs font-black flex items-center justify-center">1</div>
                                <span class="text-emerald-700 text-xs font-semibold hidden sm:inline">Data Diri</span>
                            </div>
                            <div class="flex-1 h-px bg-gradient-to-r from-emerald-300 to-gray-200 mx-1"></div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-6 h-6 rounded-full bg-emerald-200 text-emerald-700 text-xs font-black flex items-center justify-center">2</div>
                                <span class="text-gray-400 text-xs font-semibold hidden sm:inline">Jadwal</span>
                            </div>
                            <div class="flex-1 h-px bg-gray-200 mx-1"></div>
                            <div class="flex items-center gap-1.5">
                                <div class="w-6 h-6 rounded-full bg-gray-100 text-gray-400 text-xs font-black flex items-center justify-center">3</div>
                                <span class="text-gray-400 text-xs font-semibold hidden sm:inline">Konfirmasi</span>
                            </div>
                        </div>
                    </div>

                    {{-- ── THE FORM ──────────────────────────────── --}}
                    <form
                        action="{{ route('booking.store', $package->slug) }}"
                        method="POST"
                        id="booking-form"
                        novalidate
                        class="px-7 pb-8 space-y-7">
                        @csrf

                        {{-- ── GROUP 1: Personal Information ─────── --}}
                        <fieldset>
                            <legend class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 pb-3 border-b border-gray-100 w-full">
                                <span class="w-5 h-5 rounded-md bg-emerald-50 flex items-center justify-center text-emerald-600">👤</span>
                                Data Pemesan
                            </legend>

                            {{-- Nama Lengkap --}}
                            <div class="mb-5">
                                <label for="customer_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Lengkap
                                    <span class="text-red-400 ml-0.5">*</span>
                                </label>
                                <div class="relative">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        id="customer_name"
                                        name="customer_name"
                                        value="{{ old('customer_name') }}"
                                        placeholder="Contoh: Budi Santoso"
                                        required
                                        autocomplete="name"
                                        class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm font-medium text-gray-800 placeholder-gray-300 outline-none transition-all duration-200
                                            @error('customer_name')
                                                border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                            @else
                                                border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                            @enderror">
                                </div>
                                @error('customer_name')
                                    <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Email & Phone (2-col on sm+) --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                {{-- Email --}}
                                <div>
                                    <label for="customer_email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Alamat Email
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="email"
                                            id="customer_email"
                                            name="customer_email"
                                            value="{{ old('customer_email') }}"
                                            placeholder="email@contoh.com"
                                            required
                                            autocomplete="email"
                                            class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm font-medium text-gray-800 placeholder-gray-300 outline-none transition-all duration-200
                                                @error('customer_email')
                                                    border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                                @else
                                                    border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                                @enderror">
                                    </div>
                                    @error('customer_email')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- WhatsApp / Phone --}}
                                <div>
                                    <label for="customer_phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                        No. WhatsApp
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        {{-- Country prefix --}}
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <span class="text-gray-400 text-sm font-semibold">🇮🇩</span>
                                        </div>
                                        <input
                                            type="tel"
                                            id="customer_phone"
                                            name="customer_phone"
                                            value="{{ old('customer_phone') }}"
                                            placeholder="08123456789"
                                            required
                                            autocomplete="tel"
                                            class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm font-medium text-gray-800 placeholder-gray-300 outline-none transition-all duration-200
                                                @error('customer_phone')
                                                    border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                                @else
                                                    border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                                @enderror">
                                    </div>
                                    @error('customer_phone')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-400 text-xs mt-1.5">Format: 08xxx atau +628xxx (10-14 digit)</p>
                                </div>
                            </div>
                        </fieldset>


                        {{-- ── GROUP 2: Schedule & Guests ────────── --}}
                        <fieldset>
                            <legend class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 pb-3 border-b border-gray-100 w-full">
                                <span class="w-5 h-5 rounded-md bg-amber-50 flex items-center justify-center text-amber-600">📅</span>
                                Jadwal &amp; Tamu
                            </legend>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">

                                {{-- Check-in --}}
                                <div>
                                    <label for="check_in_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Check-in
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="date"
                                            id="check_in_date"
                                            name="check_in_date"
                                            value="{{ old('check_in_date') }}"
                                            min="{{ date('Y-m-d') }}"
                                            required
                                            class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm font-medium text-gray-800 outline-none transition-all duration-200 cursor-pointer
                                                @error('check_in_date')
                                                    border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                                @else
                                                    border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                                @enderror">
                                    </div>
                                    @error('check_in_date')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Check-out --}}
                                <div>
                                    <label for="check_out_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tanggal Check-out
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="date"
                                            id="check_out_date"
                                            name="check_out_date"
                                            value="{{ old('check_out_date') }}"
                                            min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                            required
                                            class="w-full pl-11 pr-4 py-3 rounded-xl border text-sm font-medium text-gray-800 outline-none transition-all duration-200 cursor-pointer
                                                @error('check_out_date')
                                                    border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                                @else
                                                    border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                                @enderror">
                                    </div>
                                    @error('check_out_date')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                {{-- Jumlah Paket --}}
                                <div>
                                @php
                                    $maxQuantity = $package->slug === 'kabin-kayu' ? 2 : 10;
                                @endphp
                                <div>
                                    <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Jumlah Paket
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 select-none">
                                            ⛺
                                        </div>
                                        <input
                                            type="number"
                                            id="quantity"
                                            name="quantity"
                                            value="{{ old('quantity', 1) }}"
                                            min="1"
                                            max="{{ $maxQuantity }}"
                                            required
                                            class="w-full pl-11 pr-14 py-3 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white outline-none text-sm font-medium text-gray-800 transition-all duration-200">
                                        <div class="absolute inset-y-0 right-0 flex flex-col border-l border-gray-200 overflow-hidden rounded-r-xl">
                                            <button type="button" onclick="stepQuantity(1)"
                                                    class="flex-1 flex items-center justify-center px-3 hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition-colors text-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"/></svg>
                                            </button>
                                            <div class="border-t border-gray-200"></div>
                                            <button type="button" onclick="stepQuantity(-1)"
                                                    class="flex-1 flex items-center justify-center px-3 hover:bg-red-50 text-gray-400 hover:text-red-400 transition-colors text-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    @error('quantity')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-400 text-xs mt-1.5">Maks. {{ $maxQuantity }} paket</p>
                                </div>
                                </div>

                                {{-- Total Guests --}}
                                <div>
                                    <label for="total_guests" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Jumlah Tamu
                                        <span class="text-red-400 ml-0.5">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        {{-- Custom number stepper --}}
                                        <input
                                            type="number"
                                            id="total_guests"
                                            name="total_guests"
                                            value="{{ old('total_guests', 1) }}"
                                            min="1"
                                            max="{{ $package->capacity }}"
                                            required
                                            class="w-full pl-11 pr-14 py-3 rounded-xl border text-sm font-medium text-gray-800 outline-none transition-all duration-200
                                                @error('total_guests')
                                                    border-red-300 bg-red-50 focus:border-red-400 focus:ring-2 focus:ring-red-100
                                                @else
                                                    border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white
                                                @enderror">
                                        {{-- Stepper buttons --}}
                                        <div class="absolute inset-y-0 right-0 flex flex-col border-l border-gray-200 overflow-hidden rounded-r-xl">
                                            <button type="button" onclick="stepGuests(1)"
                                                    class="flex-1 flex items-center justify-center px-3 hover:bg-emerald-50 text-gray-400 hover:text-emerald-600 transition-colors text-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 15l7-7 7 7"/></svg>
                                            </button>
                                            <div class="border-t border-gray-200"></div>
                                            <button type="button" onclick="stepGuests(-1)"
                                                    class="flex-1 flex items-center justify-center px-3 hover:bg-red-50 text-gray-400 hover:text-red-400 transition-colors text-xs">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                            </button>
                                        </div>
                                    </div>
                                    @error('total_guests')
                                        <p class="flex items-center gap-1.5 text-red-500 text-xs mt-2 font-medium">
                                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="text-gray-400 text-xs mt-1.5">Kapasitas maks: <strong class="text-gray-600"><span id="max-guests-label">{{ $package->capacity }}</span> orang</strong></p>
                                </div>
                            </div>

                            {{-- Duration badge (JS populated) --}}
                            <div id="duration-badge"
                                 class="hidden mt-4 flex items-center gap-2 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-xl">
                                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="duration-text" class="text-sm font-semibold"></span>
                            </div>
                        </fieldset>


                        {{-- ── GROUP 3: Special Requests (Optional) ─ --}}
                        <fieldset>
                            <legend class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 pb-3 border-b border-gray-100 w-full">
                                <span class="w-5 h-5 rounded-md bg-purple-50 flex items-center justify-center text-purple-500">💬</span>
                                Permintaan Khusus
                                <span class="normal-case text-gray-300 font-normal text-xs ml-1">(opsional)</span>
                            </legend>

                            <textarea
                                name="special_requests"
                                id="special_requests"
                                rows="3"
                                maxlength="500"
                                placeholder="Contoh: Saya membawa bayi, mohon area yang lebih tenang. Atau ada anggota dengan alergi tertentu..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 focus:bg-white text-sm text-gray-800 placeholder-gray-300 font-medium outline-none transition-all duration-200 resize-none">{{ old('special_requests') }}</textarea>
                            <p class="text-gray-400 text-xs mt-1.5">
                                <span id="chars-count">0</span>/500 karakter
                            </p>
                        </fieldset>


                        {{-- ── AGREEMENT CHECKBOX ─────────────────── --}}
                        <div class="flex items-start gap-3 bg-gray-50 border border-gray-100 rounded-2xl p-4">
                            <div class="flex-shrink-0 pt-0.5">
                                <input
                                    type="checkbox"
                                    id="agree_terms"
                                    name="agree_terms"
                                    required
                                    class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 cursor-pointer">
                            </div>
                            <label for="agree_terms" class="text-gray-600 text-sm leading-relaxed cursor-pointer">
                                Saya telah membaca dan menyetujui
                                <a href="#" class="text-emerald-600 font-semibold hover:underline">Syarat &amp; Ketentuan</a>
                                serta
                                <a href="#" class="text-emerald-600 font-semibold hover:underline">Kebijakan Privasi</a>
                                Gedoy Camping Park. Data saya akan digunakan untuk proses konfirmasi reservasi.
                            </label>
                        </div>


                        <div class="pt-2">
                            @if(($settings['sys_status'] ?? 'open') === 'closed')
                                <div class="bg-amber-50 border border-amber-200 text-amber-900 rounded-2xl p-4 text-sm flex items-start gap-3 mb-3">
                                    <span class="text-xl">⚠️</span>
                                    <div>
                                        <p class="font-bold text-sm">Sistem Reservasi Ditutup Sementara</p>
                                        <p class="text-xs text-amber-800/80 mt-0.5">{{ $settings['sys_closed_message'] ?? 'Mohon maaf, Gedoy Camping Park sedang tutup sementara untuk pemeliharaan area kemah.' }}</p>
                                    </div>
                                </div>
                                <button
                                    type="button"
                                    disabled
                                    class="w-full inline-flex items-center justify-center gap-3 bg-slate-300 text-slate-500 font-bold text-base px-8 py-4 rounded-2xl cursor-not-allowed">
                                    Reservasi Ditutup Sementara
                                </button>
                            @else
                                <button
                                    type="submit"
                                    id="submit-btn"
                                    class="group relative w-full inline-flex items-center justify-center gap-3 bg-gradient-to-r from-emerald-700 to-emerald-800 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold text-base px-8 py-4 rounded-2xl shadow-xl shadow-emerald-900/30 hover:shadow-emerald-700/40 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 overflow-hidden">
                                    {{-- Shimmer effect --}}
                                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out"></span>

                                    <svg class="relative w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="relative" id="submit-text">Kirim Pesanan Sekarang</span>
                                    <svg class="relative w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </button>
                            @endif

                            {{-- Secondary action --}}
                            <a href="{{ route('home') }}#paket"
                               class="flex items-center justify-center gap-2 mt-3 text-gray-400 hover:text-gray-600 text-sm font-medium transition-colors duration-200 py-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Kembali &amp; Pilih Paket Lain
                            </a>
                        </div>

                        {{-- ── TRUST FOOTER ───────────────────────── --}}
                        <div class="border-t border-gray-100 pt-5">
                            <div class="flex flex-wrap items-center justify-center gap-5 text-gray-400">
                                <div class="flex items-center gap-1.5 text-xs font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Data Terenkripsi
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    Konfirmasi via WhatsApp
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    Tanpa Biaya Tersembunyi
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </main>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const PRICE_PER_NIGHT = {{ $package->price }};
    const MAX_GUESTS_PER_PKG = {{ $package->capacity }};

    const quantityInput = document.getElementById('quantity');
    const guestInput = document.getElementById('total_guests');
    const maxGuestsLabel = document.getElementById('max-guests-label');

    function getQuantity() {
        return parseInt(quantityInput.value) || 1;
    }

    function getMaxGuests() {
        return MAX_GUESTS_PER_PKG * getQuantity();
    }

    function updateMaxGuests() {
        const maxLimit = getMaxGuests();
        maxGuestsLabel.textContent = maxLimit;
        guestInput.max = maxLimit;
        
        // Clamp current guests value
        const currGuests = parseInt(guestInput.value) || 1;
        if (currGuests > maxLimit) {
            guestInput.value = maxLimit;
        }
        updateEstimator();
    }

    // ── Date/Qty change → update estimator ───────────────────────
    const checkIn  = document.getElementById('check_in_date');
    const checkOut = document.getElementById('check_out_date');
    const estNights = document.getElementById('est-nights');
    const estTotal  = document.getElementById('est-total');
    const durBadge  = document.getElementById('duration-badge');
    const durText   = document.getElementById('duration-text');

    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function updateEstimator() {
        const inVal  = checkIn.value;
        const outVal = checkOut.value;
        const qty    = getQuantity();

        if (inVal && outVal) {
            const inDate  = new Date(inVal);
            const outDate = new Date(outVal);
            const diff    = Math.round((outDate - inDate) / (1000 * 60 * 60 * 24));

            if (diff > 0) {
                const total = diff * PRICE_PER_NIGHT * qty;
                estNights.textContent = diff + ' malam';
                estTotal.textContent  = formatRupiah(total);

                // Show duration badge
                durBadge.classList.remove('hidden');
                durText.textContent = `Durasi ${diff} malam · Estimasi total ${formatRupiah(total)} (${qty} paket)`;

                // Set checkout min date
                const minOut = new Date(inDate);
                minOut.setDate(minOut.getDate() + 1);
                checkOut.min = minOut.toISOString().split('T')[0];
            } else {
                estNights.textContent = '– malam';
                estTotal.textContent  = '–';
                durBadge.classList.add('hidden');
            }
        } else {
            estNights.textContent = '– malam';
            estTotal.textContent  = '–';
            durBadge.classList.add('hidden');
        }
    }

    // Quantity listeners
    quantityInput.addEventListener('input', updateMaxGuests);
    quantityInput.addEventListener('change', updateMaxGuests);

    // Auto-set checkout to next day when checkin changes
    checkIn.addEventListener('change', function () {
        const inDate = new Date(this.value);
        if (inDate) {
            const nextDay = new Date(inDate);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOut.min = nextDay.toISOString().split('T')[0];
            // If checkout is before check-in, reset it
            if (checkOut.value && new Date(checkOut.value) <= inDate) {
                checkOut.value = nextDay.toISOString().split('T')[0];
            }
        }
        updateEstimator();
    });

    checkOut.addEventListener('change', updateEstimator);

    // Trigger if old values exist (validation failed redirect)
    if (checkIn.value && checkOut.value) updateEstimator();

    // ── Steppers ─────────────────────────────────────────────
    window.stepQuantity = function (delta) {
        const qty = getQuantity();
        const next = Math.min({{ $maxQuantity }}, Math.max(1, qty + delta));
        quantityInput.value = next;
        updateMaxGuests();
    };

    window.stepGuests = function (delta) {
        const curr  = parseInt(guestInput.value) || 1;
        const next  = Math.min(getMaxGuests(), Math.max(1, curr + delta));
        guestInput.value = next;
    };

    // ── Character counter for special requests ───────────────
    const textarea  = document.getElementById('special_requests');
    const charCount = document.getElementById('chars-count');
    if (textarea) {
        textarea.addEventListener('input', function () {
            charCount.textContent = this.value.length;
        });
        charCount.textContent = textarea.value.length;
    }

    // ── Submit button loading state ──────────────────────────
    const form      = document.getElementById('booking-form');
    const submitBtn = document.getElementById('submit-btn');
    const submitTxt = document.getElementById('submit-text');

    form.addEventListener('submit', function () {
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        submitTxt.textContent = 'Mengirim Pesanan...';
    });

    // ── Real-time phone input cleanup ────────────────────────
    const phoneInput = document.getElementById('customer_phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            // Only allow digits, +
            this.value = this.value.replace(/[^\d+]/g, '');
        });
    }
})();
</script>
@endpush

@endsection