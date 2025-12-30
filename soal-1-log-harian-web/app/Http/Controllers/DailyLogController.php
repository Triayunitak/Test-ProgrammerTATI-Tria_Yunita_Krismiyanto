<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LogSubmitted;

class DailyLogController extends Controller
{
    /**
     * Menampilkan daftar log milik user yang sedang login.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Query dasar: hanya ambil log milik sendiri
        $query = DailyLog::where('user_id', $user->id_user);

        // 1. Filter berdasarkan Status (all, pending, approved, rejected)
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // 2. Search berdasarkan Activity Summary
        if ($request->has('search') && $request->search != '') {
            $query->where('activity_summary', 'like', '%' . $request->search . '%');
        }

        // 3. Sorting Logic (Fitur Latest/Oldest)
        $sortColumn = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');

        // Whitelist kolom agar aman dari SQL Injection
        if (in_array($sortColumn, ['created_at', 'log_date', 'updated_at'])) {
            $query->orderBy($sortColumn, $sortDirection);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $logs = $query->get();

        return view('logs.index', compact('logs'));
    }

    /**
     * Menyimpan log harian baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'log_date' => 'required|date|after_or_equal:today',
            'activity_summary' => 'required|string',
        ], [
            'log_date.after_or_equal' => 'Gagal! Tidak boleh mengisi log untuk hari yang sudah lewat.'
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah user sudah mengisi log pada tanggal tersebut (1 hari = 1 log)
        $exists = DailyLog::where('user_id', $user->id_user)
                          ->where('log_date', $request->log_date)
                          ->exists();
        
        if ($exists) {
            return back()->with('error', 'Gagal! Log untuk tanggal ini sudah ada.');
        }

        // Aturan: Kepala Dinas otomatis Approved, selain itu Pending
        $status = ($user->role === 'kepala_dinas') ? 'approved' : 'pending';
        $verified_by = ($user->role === 'kepala_dinas') ? $user->id_user : null;
        $verified_at = ($user->role === 'kepala_dinas') ? now() : null;

        $log = DailyLog::create([
            'user_id' => $user->id_user,
            'log_date' => $request->log_date,
            'activity_summary' => $request->activity_summary,
            'status' => $status,
            'verified_by' => $verified_by,
            'verified_at' => $verified_at
        ]);

        // --- SISTEM NOTIFIKASI REAL ---

        // 1. Notif untuk diri sendiri (Log Berhasil Dibuat)
        // Menghilangkan error Intelephense dengan type hint di atas
        $typeForSelf = ($user->role === 'kepala_dinas') ? 'status_updated' : 'log_created';
        $user->notify(new LogSubmitted($log, $typeForSelf));

        // 2. Notif untuk Atasan (Hanya jika Staff/Kabid dan punya supervisor)
        if ($user->role !== 'kepala_dinas' && $user->supervisor_id) {
            /** @var \App\Models\User $supervisor */
            $supervisor = User::find($user->supervisor_id);
            if ($supervisor) {
                // Atasan mendapat notif bahwa bawahan mengirim log butuh verifikasi
                $supervisor->notify(new LogSubmitted($log, 'verification_needed'));
            }
        }

        return back()->with('success', 'Log berhasil disimpan.');
    }

    /**
     * Memperbarui rincian kegiatan (Hanya jika status masih Pending).
     */
    public function update(Request $request, $id)
    {
        $log = DailyLog::findOrFail($id);

        // Jika sudah di-Approved/Rejected, tidak boleh edit (Final)
        if ($log->status !== 'pending') {
            return back()->with('error', 'Log yang sudah diverifikasi tidak bisa diedit.');
        }

        $log->update([
            'activity_summary' => $request->activity_summary
        ]);

        return back()->with('success', 'Log berhasil diperbarui.');
    }

    /**
     * Menghapus log (Hanya jika status masih Pending).
     */
    public function destroy($id)
    {
        $log = DailyLog::findOrFail($id);

        if ($log->status !== 'pending') {
            return back()->with('error', 'Log final tidak bisa dihapus.');
        }

        $log->delete();

        return back()->with('success', 'Log berhasil dihapus.');
    }
}