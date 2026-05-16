@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-emerald-700 font-semibold hover:text-emerald-900 transition flex items-center gap-2">
                ← Kembali ke Beranda
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
            <div class="bg-emerald-800 text-white p-8 md:w-1/3 flex flex-col justify-between">
                <div>
                    <h2 class="text-3xl font-bold mb-2">{{ $package->name }}</h2>
                    <p class="text-emerald-100 mb-6 text-sm">{{ $package->description }}</p>
                    <div class="text-2xl font-extrabold mb-4">
                        Rp {{ number_format($package->price, 0, ',', '.') }}<span class="text-sm font-normal">/malam</span>
                    </div>
                    <ul class="space-y-2 mb-8">
                        <li class="flex items-center gap-2 text-sm"><span>👥</span> Kapasitas Maks. {{ $package->capacity }} Orang</li>
                    </ul>
                </div>
                <div class="bg-emerald-900/50 p-4 rounded-xl border border-emerald-700">
                    <p class="text-xs text-emerald-100 text-center">Pastikan data yang Anda masukkan benar. Tim kami akan menghubungi Anda untuk konfirmasi pembayaran.</p>
                </div>
            </div>

            <div class="p-8 md:w-2/3">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Lengkapi Data Pesanan</h3>
                
                <form action="{{ route('booking.store', $package->slug) }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="customer_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                            <input type="email" name="customer_email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">No. WhatsApp</label>
                            <input type="text" name="customer_phone" required placeholder="0812..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Check-in</label>
                            <input type="date" name="check_in_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Check-out</label>
                            <input type="date" name="check_out_date" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jml. Orang</label>
                            <input type="number" name="total_guests" min="1" max="{{ $package->capacity }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300">
                            Konfirmasi Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection