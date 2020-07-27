<?php

namespace App\Http\Controllers\Admin;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Client;

class ClientController extends Controller
{


    use RegistersUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Clients';
        $data['clients'] = Client::all()->sortByDesc('created_at');
        return view('admin.client.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Clients';
        $data['subscriptions'] = Subscription::all()->sortBy('name');
        return view('admin.client.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['page_title'] = 'Clients';

        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'phone' => ['required', 'string',  'min:10', 'unique:clients'],
                'subscription' => ['required']
            ]
        );
        $save_data = ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'subscription_id' => $request->subscription, 'password' => Hash::make($request->phone)];
        $client = Client::create($save_data)->sendEmailVerificationNotification();;
        if ($client) {
            return redirect('admin/clients')->with('success', "Client Added Successfully.");
        } else {
            return redirect('admin/clients')->with('failure', "Oops! Client Not added.");
        }
    }
}
