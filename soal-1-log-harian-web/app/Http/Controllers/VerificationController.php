<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\LogSubmitted;

class VerificationController extends Controller
{
    /**
     * MENU: STAFF LIST
     * Menampilkan daftar bawahan langsung sesuai hierarki (Image Reference).
     * Kadin melihat Kabid, Kabid melihat Staff.
     */
    public function staffList(Request $request)
    {
        /** @var \App\Models\User $supervisor */
        $supervisor = Auth::user();

        // Ambil data bawahan langsung
        $query = User::where('supervisor_id', $supervisor->id_user);

        // Fitur Search sesuai UI (Nama atau Email)
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('user_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email_user', 'like', '%' . $request->search . '%');
            });
        }

        $subordinates = $query->orderBy('user_name', 'asc')->get();

        // Mengarahkan ke file view staff_list
        return view('verification.staff_list', compact('subordinates'));
    }

    /**
     * MENU: VERIFICATION LOGS
     * Menampilkan tabel aktivitas bawahan yang perlu di-review (Approve/Reject).
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $supervisor */
        $supervisor = Auth::user();
        
        // Ambil ID semua bawahan langsung
        $subordinateIds = User::where('supervisor_id', $supervisor->id_user)->pluck('id_user');
        
        // Ambil log aktivitas milik bawahan tersebut
        $query = DailyLog::whereIn('user_id', $subordinateIds)->with('user');

        // Filter Status (Pending, Approved, Rejected)
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $logs = $query->orderBy('created_at', 'desc')->get();
        
        return view('verification.index', compact('logs'));
    }

    /**
     * AKSI: VERIFIKASI
     * Mengubah status log menjadi Approved atau Rejected.
     */
    public function verify(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approved,rejected',
            'verification_note' => 'required_if:action,rejected'
        ], [
            'verification_note.required_if' => 'Catatan wajib diisi jika log ditolak.'
        ]);

        $log = DailyLog::findOrFail($id);
        /** @var \App\Models\User $supervisor */
        $supervisor = Auth::user();

        // Validasi keamanan hierarki
        if ($log->user->supervisor_id !== $supervisor->id_user) {
            abort(403, 'Anda tidak memiliki otoritas atas log ini.');
        }

        $log->update([
            'status' => $request->action,
            'verified_by' => $supervisor->id_user,
            'verification_note' => $request->verification_note,
            'verified_at' => now()
        ]);

        // --- KIRIM NOTIFIKASI BALIK KE BAWAHAN ---
        $subordinate = User::find($log->user_id);
        if ($subordinate) {
            $subordinate->notify(new LogSubmitted($log, 'status_updated'));
        }

        return back()->with('success', 'Status log harian berhasil diperbarui.');
    }
}