<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthenticateController extends Controller
{

    /**
     * Attempt to login the user.
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
     * Attempt to logout the user.
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
     * On success the user is logged in.
     * Fires the email verification email event on registration success.
     * @param Illuminate/Http/Request $request
     * @return Illuminate/Http/JsonResponse 
     */
    public function attemptRegister(Request $request) {
        $registerData = $request->only('reg_email', 'reg_password', 'reg_password_confirmation');
        $validation = Validator::make($registerData, [
            'reg_email' => ['bail', 'required', 'email:rfc,dns', 'string', 'unique:App\Models\User,email'],
            'reg_password' => ['bail', 'required', 'confirmed', 'alpha_num', 'regex:/\\d/', 'string', 'min:8'],
            'reg_password_confirmation' => ['bail', 'required', 'alpha_num', 'regex:/\\d/', 'string', 'min:8']
        ]);

        if ($validation->fails()) {
            $reason = $validation->failed();
            $now = Carbon::now();
            $reasonArrAsString = json_encode($reason);
            Log::info("{$now} - Registration failed -:- {$reasonArrAsString}");
            return response()->json(['success' => false, 'errors' => $reason], 422);
        }

        $userData = $validation->safe()->only(['reg_email', 'reg_password']);

        $user = User::create([
            'email' => $userData['reg_email'],
            'password' => Hash::make($userData['reg_password']),
        ]);

        Auth::login($user, false);

        event(new Registered($user));

        return response()->json(['success' => true, 'message' => 'Account created'], 201);
    }

    /**
     * Handle a contact us form request
     * Emails myself
     * Emails user if they checked to do so
     * @param Illuminate/Http/Request $request
     * @return Illuminate/Http/RedirectResponse
     */
    public function contactUs(Request $request) {
        $requestData = $request->only('contact_firstname', 'contact_lastname', 'contact_query', 'contact_email');

        $sendUserCopy = false;

        if ($request->has('contact_confirm')) {
            $sendUserCopy = true;
            $requestData = [...$requestData, $request->contact_confirm];
        }
      
        $validation = Validator::make($requestData, [
            'contact_firstname' => ['required', 'string'],
            'contact_lastname' => ['required', 'string'],
            'contact_email' => ['required', 'email:rfc,dns'],
            'contact_query' => ['required', 'string'],
            'contact_confirm' => ['sometimes', 'accepted']
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            return redirect('/')->with('errors', $errors);
        }

        (new ContactUs())
            ->populateEntry($requestData, $sendUserCopy)
            ->save();

        //Email me - set to event / listener - see AA
        //Email user if so - set to event / listener

        return redirect('/')->with([
            'contact-success' => 'Query received',
            'contact-copy' => $sendUserCopy
        ]);
    }

    public function index() {
        return view('auth.login');
    }
}
