@extends('layouts.app')

@section('title', 'Restoran Gedoy – Sajian Lezat di Tengah Alam')

@section('content')
    {{-- =============================================
         HERO SECTION – Premium Nature Resort Vibe
    ============================================== --}}
    <section class="relative bg-emerald-950 text-white overflow-hidden py-24 sm:py-32">
        {{-- Background Image with Emerald Overlay --}}
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1470&auto=format&fit=crop"
                 alt="Restoran Gedoy Culinary"
                 class="w-full h-full object-cover object-center opacity-30 transform scale-105 transition-transform duration-1000">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/80 to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-400/10 text-amber-400 border border-amber-400/20 uppercase tracking-widest mb-6 animate-pulse">
                🍴 Kuliner Premium Resort
            </span>
            <h1 class="font-serif-luxury text-4xl sm:text-5xl lg:text-6xl text-white font-bold tracking-tight mb-6 leading-tight">
                Restoran <span class="text-gold-gradient font-extrabold">Gedoy</span>
            </h1>
            <p class="max-w-2xl mx-auto text-base sm:text-lg text-emerald-100/90 leading-relaxed font-medium">
                Sajian lezat di tengah tenangnya alam. Pesan sekarang dari tenda Anda, kami antar langsung dengan kehangatan khas pedesaan Ciater.
            </p>
        </div>
    </section>

    {{-- =============================================
         RESTAURANT VIEW BODY
    ============================================== --}}
    <section class="py-12 sm:py-16 bg-[#fcfbf9]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Category Tabs Section --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pb-8 border-b border-emerald-100 mb-10">
                <div>
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl text-emerald-950 font-bold">Daftar Menu Hidangan</h2>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Pilih kategori menu untuk menyaring hidangan favorit Anda.</p>
                </div>

                {{-- Sleek, horizontal scrollable tab menu --}}
                <div class="w-full md:w-auto overflow-x-auto pb-2 md:pb-0 scrollbar-none flex items-center gap-2 sm:gap-3">
                    @php
                        $categories = [
                            'Semua' => '🍽️ Semua',
                            'Makanan Utama' => '🍲 Makanan Utama',
                            'Dessert' => '🍰 Dessert',
                            'Minuman' => '🥤 Minuman'
                        ];
                    @endphp

                    @foreach($categories as $key => $label)
                        <a href="{{ route('restaurant.index', ['category' => $key]) }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-bold tracking-wide whitespace-nowrap border transition-all duration-300 shadow-sm
                           {{ $activeCategory === $key
                               ? 'bg-emerald-900 text-amber-400 border-amber-500/30 shadow-emerald-900/10 scale-105'
                               : 'bg-white text-emerald-800 hover:bg-emerald-50 border-emerald-100'
                           }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Menu Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($menus as $menu)
                    @php
                        // Map local menu seed name to gorgeous Unsplash photos
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
                        $menuImage = $imageMap[$menu->name] ?? $defaultImage;
                    @endphp

                    {{-- Menu Card UI --}}
                    <div class="group bg-white rounded-2xl border border-emerald-100/60 shadow-md hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col overflow-hidden h-full">
                        
                        {{-- Image Container --}}
                        <div class="relative h-48 overflow-hidden bg-emerald-950/5">
                            <img src="{{ $menuImage }}"
                                 alt="{{ $menu->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            
                            {{-- Category Badge --}}
                            <span class="absolute top-3 left-3 bg-white/95 backdrop-blur-sm text-emerald-950 text-[11px] font-extrabold px-3 py-1 rounded-full shadow-sm border border-emerald-50 uppercase tracking-wider">
                                {{ $menu->category }}
                            </span>
                        </div>

                        {{-- Details Body --}}
                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="font-bold text-gray-900 text-lg leading-tight group-hover:text-emerald-900 transition-colors">
                                {{ $menu->name }}
                            </h3>
                            <p class="text-gray-500 text-sm mt-2 line-clamp-3 leading-relaxed flex-1">
                                {{ $menu->description }}
                            </p>

                            {{-- Price & Add to Cart form --}}
                            <div class="mt-5 pt-4 border-t border-emerald-50/80 flex items-center justify-between gap-4">
                                <div class="flex flex-col">
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Harga</span>
                                    <span class="text-emerald-700 font-black text-lg">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Action Form --}}
                                <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-800 to-emerald-900 hover:from-emerald-900 hover:to-emerald-950 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                                        <span>➕</span> Masukkan
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 bg-white rounded-3xl border border-emerald-100/50 shadow-sm flex flex-col items-center justify-center text-center px-6">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 flex items-center justify-center text-3xl mb-4 text-emerald-700">🥗</div>
                        <h3 class="font-serif-luxury text-xl text-emerald-950 font-bold">Menu Tidak Ditemukan</h3>
                        <p class="text-gray-500 text-sm mt-1.5 max-w-sm">Maaf, saat ini tidak ada menu hidangan yang tersedia untuk kategori ini.</p>
                        <a href="{{ route('restaurant.index') }}"
                           class="mt-6 inline-flex items-center gap-2 bg-emerald-900 text-amber-400 font-bold text-sm px-6 py-2.5 rounded-full hover:bg-emerald-950 transition-colors">
                            Lihat Semua Menu
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
@endsection
