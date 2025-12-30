<?php

use App\Http\Controllers\HelloWorldController;
use Illuminate\Support\Facades\Route;

Route::get('/helloworld', [HelloWorldController::class, 'index']);