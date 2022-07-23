<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticateController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/', [AuthenticateController::class, 'index'])->name('login_view')->middleware('guest');

Route::post('login', [AuthenticateController::class, 'attemptLogin'])->name('login_post_url')->middleware(['throttle:form_submit']); 

Route::post('/logout', [AuthenticateController::class, 'attemptLogout'])->name('logout_post_url');

Route::post('/register', [AuthenticateController::class, 'attemptRegister'])->name('register_post_url')->middleware('throttle:XML_submit');

Route::get('/email/verify', fn() => view('auth.verify-email-notify'))->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


//Change url from coming in as nginx
//FInd out why $request->fulfill not filling in datetime - confirm not because not in $fillable array on user model