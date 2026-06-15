<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantOrder;
use Illuminate\Http\Request;

class AdminRestaurantOrderController extends Controller
{
    public function index(Request $request)
    {
        $range = $request->query('range', 'all');

        // Stats queries based on selected range
        $statsQuery = RestaurantOrder::query();
        if ($range === 'today') {
            $statsQuery->where('created_at', '>=', now()->startOfDay());
        } elseif ($range === 'week') {
            $statsQuery->where('created_at', '>=', now()->subDays(7)->startOfDay());
        } elseif ($range === 'month') {
            $statsQuery->where('created_at', '>=', now()->subDays(30)->startOfDay());
        }

        $totalOrdersCount = $statsQuery->count();
        $pendingCount = RestaurantOrder::where('status', 'pending')->count(); // Menunggu validasi (All-time pending)
        
        // Pendapatan bersih only from completed orders within range
        $netRevenue = $statsQuery->where('status', 'completed')->sum('grand_total');

        // List of all orders with items and menus relations
        $orders = RestaurantOrder::with(['user', 'items.menu'])
            ->latest()
            ->get();

        return view('admin.restaurant-orders', compact('orders', 'totalOrdersCount', 'pendingCount', 'netRevenue', 'range'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = RestaurantOrder::findOrFail($id);
        $order->update(['status' => $request->status]);

        $statusLabels = [
            'pending' => 'Pending ⏳',
            'processing' => 'Sedang Dimasak 👨‍🍳',
            'completed' => 'Selesai Diantar ✅',
            'cancelled' => 'Dibatalkan ❌'
        ];

        return redirect()->route('admin.restaurant_orders.index')->with('success', 'Pesanan #' . $order->id . ' diubah statusnya menjadi ' . $statusLabels[$request->status]);
    }

    public function destroy($id)
    {
        $order = RestaurantOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.restaurant_orders.index')->with('success', 'Pesanan #' . $id . ' berhasil dihapus dari sistem 🗑️');
    }
}
