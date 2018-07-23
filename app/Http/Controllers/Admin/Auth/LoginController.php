<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email',
            'password' => 'required|min:6'
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $remember = $request->remember;
        if (!(Auth::guard('admin')->attempt($credentials, $remember))) {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Invalid Email or Password']);
        }
        return redirect()->intended(route('admin.dashboard'));
    }
}
