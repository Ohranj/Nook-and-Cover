<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{

    /**
     * Attempt to login the user. Receives a request object with the users credentials
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function attemptLogin(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['filled']
        ]);

        $rememberUserBool = boolval($request->remember) ?: false;

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $rememberUserBool)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        };

        return back()->withErrors([
            'credentials' => 'The credentials provided are invalid. Please check and try again.'
        ]);
    }

    /**
     * Attempt to logout the user. Receives a request object
     * @param Illuminate\Http\Request $request
     * @return redirect
     */
    public function attemptLogout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index() {
        return view('login');
    }
}
