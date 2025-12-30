<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. STATISTIK (Untuk Pie Chart & Summary)
        // Menghitung jumlah log berdasarkan status milik user yang sedang login
        $stats = [
            'pending'  => DailyLog::where('user_id', $user->id_user)->where('status', 'pending')->count(),
            'approved' => DailyLog::where('user_id', $user->id_user)->where('status', 'approved')->count(),
            'rejected' => DailyLog::where('user_id', $user->id_user)->where('status', 'rejected')->count(),
        ];

        // 2. DATA GRAFIK PER TAHUN (2020-2025)
        // Kita hitung jumlah log yang dibuat user tersebut setiap tahunnya
        $chartData = [];
        $years = [2020, 2021, 2022, 2023, 2024, 2025];
        
        foreach ($years as $year) {
            $chartData[] = DailyLog::where('user_id', $user->id_user)
                ->whereYear('log_date', $year)
                ->count();
        }

        // 3. NOTIFIKASI REJECT (Notes)
        // Ambil 5 log terakhir yang statusnya 'rejected' untuk ditampilkan alasannya
        $rejectedLogs = DailyLog::where('user_id', $user->id_user)
                            ->where('status', 'rejected')
                            ->orderBy('log_date', 'desc')
                            ->take(5)
                            ->get();

        // Kirim semua data ini ke View 'dashboard.index'
        return view('dashboard.index', compact('stats', 'chartData', 'years', 'rejectedLogs'));
    }
}