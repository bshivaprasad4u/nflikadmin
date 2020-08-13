<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Client;

class ClientProfileController extends Controller
{
    protected $guard = 'client';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['page_title'] = 'Channel Details';
        return view('client.profile.change_password', $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => 'required|min:8|max:25',
            'new_confirm_password' => ['same:new_password'],
        ]);

        $password = Client::find(auth('client')->user()->id)->update(['password' => Hash::make($request->new_password)]);

        if ($password) {
            return redirect('client/dashboard/')->with('success', "Password Changed Successfully.");
        } else {
            return redirect('client/dashboard')->with('failure', "Oops! something went wrong.");
        }
    }
}
