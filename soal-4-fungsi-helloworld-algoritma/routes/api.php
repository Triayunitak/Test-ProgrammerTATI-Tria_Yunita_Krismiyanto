<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;

// Endpoint 1: Versi Biasa (Contoh Output: [1, 2, 3, "hello"])
Route::get('/helloworld', [HelloWorldController::class, 'index']);

// Endpoint 2: Versi Bertingkat (Contoh Output: ["helloworld(1) => 1", ...])
Route::get('/helloworld-list', [HelloWorldController::class, 'list']);