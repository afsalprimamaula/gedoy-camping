@extends('layouts.app')

@section('content')
    <div class="relative bg-emerald-900 text-white overflow-hidden min-h-screen flex items-center">
        <div class="absolute inset-0 opacity-50">
            <img src="https://images.unsplash.com/photo-1533873984035-25970ab07461?auto=format&fit=crop&w=1920&q=80" alt="Gedoy Camping Ground" class="w-full h-full object-cover" />
        </div>
        <div class="relative container mx-auto px-6 text-center z-10 mt-16">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo Gedoy" class="w-32 h-32 mx-auto rounded-full border-4 border-amber-500 shadow-xl mb-8">
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-4 drop-shadow-lg">
                Gedoy <span class="text-amber-400">Camping Park</span>
            </h1>
            <p class="mt-6 text-lg md:text-2xl text-gray-100 max-w-3xl mx-auto mb-10 drop-shadow-md leading-relaxed">
                Destinasi berkemah bernuansa alam di Nagrak, Ciater. Nikmati ketenangan tepi sungai dan sejuknya hutan pinus, hanya 15 menit dari pusat Ciater.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="#paket" class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-lg py-4 px-10 rounded-full shadow-2xl transition duration-300 transform hover:scale-105">
                    Reservasi Sekarang
                </a>
                <a href="https://wa.me/6281222099317" target="_blank" class="bg-transparent border-2 border-white hover:bg-white hover:text-emerald-900 text-white font-bold text-lg py-4 px-10 rounded-full transition duration-300">
                    Hubungi Admin
                </a>
            </div>
        </div>
    </div>

    <div id="paket" class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-emerald-800 mb-4">Pilihan Paket Berkemah</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Tersedia dua area eksklusif yang dirancang khusus untuk kenyamanan dan ketenangan Anda menyatu dengan alam.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
                @foreach($packages as $package)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden group hover:shadow-2xl transition duration-300 flex flex-col justify-between">
                    <div>
                        <div class="h-64 bg-emerald-200 relative overflow-hidden">
                            @if($package->slug == 'river-camp')
                                <img src="https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=800&q=80" alt="River Camp" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?auto=format&fit=crop&w=800&q=80" alt="Pinus Camp" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @endif
                        </div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-2xl font-bold text-gray-800">{{ $package->name }}</h3>
                                <span class="text-emerald-700 font-extrabold text-xl">Rp {{ number_format($package->price, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/malam</span></span>
                            </div>
                            <p class="text-gray-600 mb-6">{{ $package->description }}</p>
                            
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($package->features as $feature)
                                    <span class="bg-emerald-50 text-emerald-700 text-xs px-3 py-1 rounded-full font-semibold border border-emerald-100">
                                        ✓ {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="px-8 pb-8">
                        <a href="{{ route('booking.show', $package->slug) }}" class="block text-center bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 px-6 rounded-xl transition duration-300 shadow-md">
                            Pilih {{ $package->name }}
                        </a>
                    </div>
                </div>
                @endforeach
                </div>
        </div>
    </div>

    <div class="py-20 bg-emerald-800 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12">Fasilitas Pendukung</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <div class="text-4xl mb-3">🅿️</div>
                    <p class="font-semibold">Area Parkir Luas</p>
                </div>
                <div>
                    <div class="text-4xl mb-3">🚿</div>
                    <p class="font-semibold">Toilet & Kamar Mandi Bersih</p>
                </div>
                <div>
                    <div class="text-4xl mb-3">🕌</div>
                    <p class="font-semibold">Musala</p>
                </div>
                <div>
                    <div class="text-4xl mb-3">⛺</div>
                    <p class="font-semibold">Sewa Tenda & Matras</p>
                </div>
            </div>
        </div>
    </div>
@endsection