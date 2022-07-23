<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', fn() => view('dashboard'));
});
