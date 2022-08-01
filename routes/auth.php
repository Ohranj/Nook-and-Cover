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

Route::post('/contact', [AuthenticateController::class, 'contactUs'])->name('contact_us_post_url');


//Change url from coming in as nginx when in browserSync mode
//See AuthController list items
//Style email not verified page
//Create a send verification again button
//Add a forgot password feature
//Add glass appreance on logged in pages