<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan absensi harian.
     */
    public function dailyReport(Request $request)
    {
        // Tentukan tanggal. Kalau user input tanggal, pakai itu. Kalau nggak, pakai hari ini.
        $date = $request->input('date') 
            ? Carbon::parse($request->input('date')) 
            : Carbon::now('Asia/Makassar');

        // Ambil data absensi pada tanggal yang dipilih
        // Pakai 'with' buat ambil data relasi 'employee' sekalian (Eager Loading style!)
        $attendances = Attendance::with('employee')
                                ->whereDate('date', $date)
                                ->orderBy('created_at', 'desc')
                                ->get();

        // Kirim data ke view
        return view('admin.reports.daily', [
            'attendances' => $attendances,
            'selectedDate' => $date->format('Y-m-d'),
        ]);
    }
}