<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- GUEST ROUTES ---
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- AUTHENTICATED ROUTES ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Daily Logs (Log Pribadi)
    Route::resource('logs', DailyLogController::class)->except(['create', 'show', 'edit']);

    // 3. Menu Staff List (Hanya menampilkan daftar pegawai bawahan)
    Route::get('/staff-list', [VerificationController::class, 'staffList'])->name('verification.staff');

    // 4. Menu Verification Logs (Tempat menyetujui/menolak log bawahan)
    Route::get('/verification', [VerificationController::class, 'index'])->name('verification.index');
    Route::post('/verification/{id}', [VerificationController::class, 'verify'])->name('verification.verify');

    // 5. Notifikasi (Mark as Read)
    Route::post('/notifications/mark-all-read', function () {
        /** @var \App\Models\User $user */
        $user = Auth::user(); 
        if ($user) {
            $user->unreadNotifications->markAsRead();
        }
        return back();
    })->name('notifications.markAllRead');
});