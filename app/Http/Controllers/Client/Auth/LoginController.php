<?php

namespace App\Http\Controllers\Client\Auth;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Client\Controller as ClientController;

class LoginController extends ClientController
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::CLIENT;

    protected function guard() // And now finally this is our custom guard name
    {
        return Auth::guard('client');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }
    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard('client')->logout();

        $request->session()->invalidate();

        return redirect('/client/login');
    }
}
