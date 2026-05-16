@extends('layouts.app')

@section('content')
    <div class="relative bg-emerald-800 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-40">
            <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" alt="Camping Ground" class="w-full h-full object-cover" />
        </div>
        <div class="relative container mx-auto px-6 py-32 text-center md:py-48">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-4 shadow-sm">
                Menyatu dengan Alam di <span class="text-amber-400">Gedoy</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-gray-200 max-w-2xl mx-auto mb-10">
                Rasakan pengalaman glamping dan kemah eksklusif dengan pemandangan pegunungan Ciater yang menenangkan. Lepaskan penat, temukan kedamaian.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#paket" class="bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300">
                    Pesan Paket Sekarang
                </a>
                <a href="#fasilitas" class="bg-transparent border-2 border-white hover:bg-white hover:text-emerald-900 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                    Lihat Fasilitas
                </a>
            </div>
        </div>
    </div>

    <div id="fasilitas" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-emerald-800 mb-12">Fasilitas Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-emerald-50 rounded-lg shadow-sm">
                    <div class="text-4xl mb-4">🏕️</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tenda Premium</h3>
                    <p class="text-gray-600">Tenda luas anti-badai dilengkapi kasur tebal dan selimut hangat.</p>
                </div>
                <div class="p-6 bg-emerald-50 rounded-lg shadow-sm">
                    <div class="text-4xl mb-4">🔥</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Private Campfire</h3>
                    <p class="text-gray-600">Area api unggun pribadi untuk BBQ dan bersantai bersama keluarga.</p>
                </div>
                <div class="p-6 bg-emerald-50 rounded-lg shadow-sm">
                    <div class="text-4xl mb-4">🚿</div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Kamar Mandi Air Panas</h3>
                    <p class="text-gray-600">Kamar mandi bersih dengan sumber air panas alami khas Ciater.</p>
                </div>
            </div>
        </div>
    </div>
@endsection