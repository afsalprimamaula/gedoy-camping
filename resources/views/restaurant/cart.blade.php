@extends('layouts.app')

@section('title', 'Keranjang Belanja Restoran – Gedoy Camping')

@section('content')
    <div class="bg-slate-50 min-h-screen py-10 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-10">
                <a href="{{ route('restaurant.index') }}" class="inline-flex items-center gap-2 text-emerald-800 hover:text-emerald-950 font-bold text-sm mb-4 transition-colors">
                    <span>⬅️</span> Kembali ke Menu Restoran
                </a>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl text-emerald-950 font-bold">Keranjang Restoran Anda</h1>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">Kelola hidangan pilihan Anda sebelum melakukan pemesanan.</p>
            </div>

            @if(empty($cart))
                {{-- Empty Cart State --}}
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-12 sm:p-16 text-center max-w-2xl mx-auto flex flex-col items-center">
                    <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center text-4xl mb-6 text-emerald-800 shadow-inner">
                        🛒
                    </div>
                    <h2 class="font-serif-luxury text-2xl text-emerald-950 font-bold">Keranjang Belanja Kosong</h2>
                    <p class="text-gray-500 text-sm mt-3 max-w-md leading-relaxed">
                        Anda belum menambahkan hidangan lezat ke dalam keranjang belanja. Jelajahi menu kami dan pesan hidangan favorit Anda.
                    </p>
                    <a href="{{ route('restaurant.index') }}"
                       class="mt-8 inline-flex items-center gap-2 bg-emerald-900 hover:bg-emerald-950 text-white font-bold text-sm px-8 py-3.5 rounded-xl shadow-lg shadow-emerald-900/20 hover:shadow-emerald-900/40 transition-all duration-300 hover:-translate-y-0.5">
                        Lihat Menu Restoran
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- Left Column: Cart Items List --}}
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                            <div class="px-6 py-4 bg-emerald-950/5 border-b border-slate-100">
                                <h3 class="font-bold text-emerald-950 text-sm uppercase tracking-wider">Item Hidangan ({{ count($cart) }})</h3>
                            </div>

                            <div class="divide-y divide-slate-100">
                                @foreach($cart as $id => $item)
                                    @php
                                        // Map local menu seed name to gorgeous Unsplash photos (identical to index page)
                                        $imageMap = [
                                            'Nasi Goreng Kampung Premium' => 'https://images.unsplash.com/photo-1616645300522-83b6329ff07d?q=80&w=600&auto=format&fit=crop',
                                            'Sate Maranggi Ciater' => 'https://images.unsplash.com/photo-1529193591184-b1d58069ecdd?q=80&w=600&auto=format&fit=crop',
                                            'Iga Bakar Madu Hutan' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=600&auto=format&fit=crop',
                                            'Pisang Bakar Keju Caramel' => 'https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?q=80&w=600&auto=format&fit=crop',
                                            'Roti Bakar Bandung Special' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?q=80&w=600&auto=format&fit=crop',
                                            'Wedang Ronde Jahe Merah' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?q=80&w=600&auto=format&fit=crop',
                                            'Es Kelapa Muda Jeruk' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?q=80&w=600&auto=format&fit=crop',
                                            'Teh Sereh Lemon Hangat' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=600&auto=format&fit=crop',
                                        ];
                                        $defaultImage = 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=600&auto=format&fit=crop';
                                        $menuImage = $imageMap[$item['name']] ?? $defaultImage;
                                    @endphp

                                    {{-- Individual Item Row --}}
                                    <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 hover:bg-slate-50/50 transition-colors">
                                        
                                        {{-- Image + Title --}}
                                        <div class="flex items-center gap-4 flex-1">
                                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 border border-slate-100 flex-shrink-0">
                                                <img src="{{ $menuImage }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <span class="inline-block bg-emerald-50 text-emerald-800 text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider mb-1">
                                                    {{ $item['category'] }}
                                                </span>
                                                <h4 class="font-bold text-gray-900 text-base leading-tight truncate">{{ $item['name'] }}</h4>
                                                <p class="text-emerald-700 font-semibold text-sm mt-1">
                                                    Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>

                                        {{-- Quantity Adjuster & Remove Button --}}
                                        <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto">
                                            
                                            {{-- +/- Adjuster Form --}}
                                            <div class="flex items-center border border-slate-200 rounded-xl bg-white p-1">
                                                {{-- Decrease --}}
                                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="action" value="decrease">
                                                    <button type="submit" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-sm font-black text-gray-600 transition-colors">
                                                        ➖
                                                    </button>
                                                </form>

                                                {{-- Quantity Display --}}
                                                <span class="w-10 text-center font-bold text-gray-800 text-sm">
                                                    {{ $item['quantity'] }}
                                                </span>

                                                {{-- Increase --}}
                                                <form action="{{ route('cart.update') }}" method="POST" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="hidden" name="action" value="increase">
                                                    <button type="submit" class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center text-sm font-black text-gray-600 transition-colors">
                                                        ➕
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- Subtotal per item & Remove button --}}
                                            <div class="text-right flex items-center gap-4">
                                                <div class="hidden sm:block">
                                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Total</span>
                                                    <span class="font-bold text-gray-900 text-sm">
                                                        Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                                    </span>
                                                </div>

                                                {{-- Remove Form --}}
                                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-10 h-10 rounded-xl border border-red-100 hover:border-red-200 bg-red-50/50 hover:bg-red-50 text-red-600 hover:text-red-700 flex items-center justify-center transition-all duration-200"
                                                            title="Hapus hidangan">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Checkout Form & Summary --}}
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-lg p-6 md:sticky md:top-24 space-y-6">
                            
                            {{-- Header --}}
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Ringkasan Pemesanan</h3>
                                <p class="text-xs text-gray-400 mt-0.5">Rincian harga dan informasi pengiriman ke tenda Anda.</p>
                            </div>

                            {{-- Price breakdown --}}
                            <div class="space-y-3 pt-4 border-t border-slate-100 text-sm">
                                <div class="flex items-center justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between text-gray-600">
                                    <span>Pajak Restoran (11%)</span>
                                    <span class="font-semibold text-gray-900">
                                        Rp {{ number_format($tax, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-dashed border-slate-200">
                                    <span class="font-bold text-gray-900 text-base">Total Bayar</span>
                                    <span class="font-black text-emerald-700 text-lg">
                                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Delivery & Checkout Form --}}
                            <form action="{{ route('cart.checkout') }}" method="POST" class="space-y-4 pt-4 border-t border-slate-100">
                                @csrf

                                {{-- Tent / Location --}}
                                <div class="space-y-1.5">
                                    <label for="tenda_number" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">
                                        Nomor Tenda / Lokasi Antar <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                           id="tenda_number"
                                           name="tenda_number"
                                           required
                                           placeholder="Contoh: Tenda Deluxe A1 / Glamping Kayu B"
                                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                                </div>

                                {{-- Delivery Time --}}
                                <div class="space-y-1.5">
                                    <label for="delivery_time" class="text-xs font-bold text-gray-700 uppercase tracking-wider block">
                                        Waktu Pengantaran <span class="text-red-500">*</span>
                                    </label>
                                    <select id="delivery_time"
                                            name="delivery_time"
                                            required
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:bg-white focus:border-emerald-600 focus:outline-none transition-colors">
                                        <option value="Segera (15-30 menit)">Segera (15 - 30 menit)</option>
                                        <option value="Sore Hari (16.00 - 17.00)">Sore Hari (16.00 - 17.00)</option>
                                        <option value="Makan Malam (18.30 - 19.30)">Makan Malam (18.30 - 19.30)</option>
                                        <option value="Sarapan Besok (07.30 - 08.30)">Sarapan Besok (07.30 - 08.30)</option>
                                    </select>
                                </div>

                                {{-- Notice --}}
                                <div class="bg-amber-50 rounded-xl border border-amber-100 p-3.5 flex items-start gap-2.5">
                                    <span class="text-base flex-shrink-0 mt-0.5">ℹ️</span>
                                    <p class="text-[11px] text-amber-800 leading-relaxed font-medium">
                                        Makanan akan dimasak segar dan diantarkan langsung ke tenda Anda. Pembayaran akan ditagihkan ke billing kamar Anda.
                                    </p>
                                </div>

                                {{-- Submit --}}
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-emerald-800 to-emerald-900 hover:from-emerald-900 hover:to-emerald-950 text-white font-bold text-sm py-4 rounded-xl shadow-lg shadow-emerald-900/20 hover:shadow-emerald-900/40 transition-all duration-300 hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 cursor-pointer mt-6">
                                    <span>Pesan & Bayar Sekarang</span> ➔
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>
@endsection
