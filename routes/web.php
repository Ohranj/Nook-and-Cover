<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', fn() => view('dashboard'));
});
