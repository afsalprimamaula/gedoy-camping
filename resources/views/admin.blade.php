@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="container mx-auto px-6 max-w-7xl">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">📊 Dashboard Pengelola</h1>
                <p class="text-gray-500 mt-1">Validasi reservasi dan pantau pendapatan Gedoy Camping Ground.</p>
            </div>
            <a href="{{ route('home') }}" class="bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50 font-semibold py-2 px-6 rounded-lg shadow-sm transition duration-300 flex items-center gap-2">
                ← Tampilan Pengunjung
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-amber-500 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Menunggu Validasi</p>
                    <p class="text-4xl font-black text-gray-800">{{ $pendingCount }} <span class="text-xl font-medium text-gray-500">Antrean</span></p>
                </div>
                <div class="text-5xl opacity-20">⏳</div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-emerald-500 flex items-center justify-between hover:shadow-md transition">
                <div>
                    <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-1">Pendapatan Dikonfirmasi</p>
                    <p class="text-4xl font-black text-emerald-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
                <div class="text-5xl opacity-20">💰</div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
            <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-800">Manajemen Reservasi</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-800 text-white text-xs uppercase tracking-widest">
                            <th class="py-4 px-6 font-semibold">Kode & Info Kontak</th>
                            <th class="py-4 px-6 font-semibold">Paket & Jadwal</th>
                            <th class="py-4 px-6 font-semibold">Total Tagihan</th>
                            <th class="py-4 px-6 font-semibold text-center">Status</th>
                            <th class="py-4 px-6 font-semibold text-center">Aksi (Validasi)</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            
                            <td class="py-4 px-6">
                                <span class="text-xs font-bold text-emerald-600 bg-emerald-100 px-2 py-1 rounded">{{ $booking->booking_code }}</span>
                                <p class="font-bold text-gray-800 mt-2 text-base">{{ $booking->customer_name }}</p>
                                <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_phone) }}" target="_blank" class="hover:text-emerald-600">📞 {{ $booking->customer_phone }}</a>
                                </div>
                            </td>
                            
                            <td class="py-4 px-6">
                                <p class="font-bold text-emerald-800 mb-1">{{ $booking->campingPackage->name }} ({{ $booking->total_guests }} Org)</p>
                                <div class="text-xs font-semibold">
                                    <span class="text-gray-500">IN:</span> {{ \Carbon\Carbon::parse($booking->check_in_date)->translatedFormat('d M Y') }} <br>
                                    <span class="text-gray-500">OUT:</span> {{ \Carbon\Carbon::parse($booking->check_out_date)->translatedFormat('d M Y') }}
                                </div>
                            </td>
                            
                            <td class="py-4 px-6 font-extrabold text-gray-800">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            
                            <td class="py-4 px-6 text-center">
                                @if($booking->status == 'pending')
                                    <span class="bg-amber-100 text-amber-700 py-1 px-3 rounded-full text-xs font-bold uppercase tracking-wider border border-amber-200 shadow-sm animate-pulse">Menunggu</span>
                                @elseif($booking->status == 'confirmed')
                                    <span class="bg-emerald-100 text-emerald-700 py-1 px-3 rounded-full text-xs font-bold uppercase tracking-wider border border-emerald-200">Selesai</span>
                                @else
                                    <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-xs font-bold uppercase tracking-wider border border-red-200">Dibatalkan</span>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-center">
                                @if($booking->status == 'pending')
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="confirmed">
                                            <button type="submit" onclick="return confirm('Apakah pelanggan ini sudah membayar dan Anda ingin MENGONFIRMASI pesanan ini?')" class="bg-emerald-500 hover:bg-emerald-600 text-white p-2 rounded shadow transition hover:scale-110" title="Terima Pesanan">
                                                ✅
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.updateStatus', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" onclick="return confirm('Tolak/Batalkan pesanan ini?')" class="bg-amber-500 hover:bg-amber-600 text-white p-2 rounded shadow transition hover:scale-110" title="Tolak Pesanan">
                                                ❌
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <form action="{{ route('admin.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus permanen data pesanan ini dari database? Tindakan ini tidak bisa dibatalkan.')" class="bg-red-100 hover:bg-red-500 text-red-700 hover:text-white py-1 px-3 rounded border border-red-200 font-bold text-xs transition duration-300">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500 font-medium">
                                Belum ada data reservasi yang masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection