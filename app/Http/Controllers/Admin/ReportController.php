<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->get('end_date', now()->format('Y-m-d'));

        // Confirmed bookings within date range (based on check_out_date)
        $confirmedBookings = Booking::with('campingPackage')
            ->where('status', 'confirmed')
            ->whereBetween('check_out_date', [$startDate, $endDate])
            ->latest()
            ->get();

        $totalRevenue = $confirmedBookings->sum('total_price');

        // Omset bulan ini (regardless of date filter)
        $omsetBulanIni = Booking::where('status', 'confirmed')
            ->whereMonth('check_out_date', now()->month)
            ->whereYear('check_out_date', now()->year)
            ->sum('total_price');

        $totalBulanIni = Booking::where('status', 'confirmed')
            ->whereMonth('check_out_date', now()->month)
            ->whereYear('check_out_date', now()->year)
            ->count();

        return view('admin.reports', compact(
            'confirmedBookings',
            'totalRevenue',
            'omsetBulanIni',
            'totalBulanIni',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate   = $request->get('end_date', now()->format('Y-m-d'));

        $bookings = Booking::with('campingPackage')
            ->where('status', 'confirmed')
            ->whereBetween('check_out_date', [$startDate, $endDate])
            ->latest()
            ->get();

        // Simple CSV export
        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=laporan-keuangan-{$startDate}-{$endDate}.csv",
        ];

        $rows = [];
        $rows[] = ['No', 'Kode Booking', 'Pelanggan', 'Email', 'Paket', 'Tgl Keluar', 'Total Bayar'];
        foreach ($bookings as $i => $b) {
            $rows[] = [
                $i + 1,
                $b->booking_code,
                $b->customer_name,
                $b->customer_email,
                $b->campingPackage->name ?? '-',
                $b->check_out_date,
                $b->total_price,
            ];
        }
        // Grand total row
        $rows[] = ['', '', '', '', '', 'TOTAL', $bookings->sum('total_price')];

        $callback = function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM for Excel
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
