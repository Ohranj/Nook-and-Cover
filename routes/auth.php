<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;

Route::get('/', [AuthenticateController::class, 'index'])->name('login_view')->middleware('guest');

Route::post('login', [AuthenticateController::class, 'attemptLogin'])->name('login_post_url')->middleware(['throttle:form_submit']); 

Route::post('/logout', [AuthenticateController::class, 'attemptLogout'])->name('logout_post_url');

Route::post('/register', [AuthenticateController::class, 'attemptRegister'])->name('register_post_url');

