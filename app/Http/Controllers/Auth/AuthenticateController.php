<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Attempts the registration of a user.
     * @param Illuminate/Http/Request $request
     * @return string json
     */
    public function attemptRegister(Request $request) {
        $validation = Validator::make($request->only('reg_email', 'reg_password', 'reg_password_confirmation'), [
            'reg_email' => ['bail', 'required', 'email:rfc,dns', 'string', 'unique:App\Models\User,email'],
            'reg_password' => ['bail', 'required', 'confirmed', 'alpha_num', 'regex:/\\d/', 'string', 'min:8'],
            'reg_password_confirmation' => ['bail', 'required', 'alpha_num', 'regex:/\\d/', 'string', 'min:8']
        ]);

        if ($validation->fails()) {
            $reason = $validation->failed();
            return response()->json(['success' => false, 'errors' => $reason], 422);
        }

        return response()->json(['success' => true, 'data' => $request->all(), 201]);
    }

    public function index() {
        return view('login');
    }
}
