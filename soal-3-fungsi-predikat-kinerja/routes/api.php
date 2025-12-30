<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KinerjaController;


Route::get('/predikat-kinerja', [KinerjaController::class, 'cekPredikat']);