<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'staff') {
            return view('dashboard.staff');
        } elseif ($user->role === 'kepala_bidang') {
            return view('dashboard.kabid');
        } elseif ($user->role === 'kepala_dinas') {
            return view('dashboard.kadis');
        }

        abort(403, 'Unauthorized');
    }
}
