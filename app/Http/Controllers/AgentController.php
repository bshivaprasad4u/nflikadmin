<?php

namespace App\Http\Controllers;

//use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Agent;

class AgentController extends Controller
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
        $data['agents'] = Agent::all()->sortByDesc('created_at');
        return view('client.agent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$data['subscriptions'] = Subscription::all()->sortBy('name');
        return view('client.agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'phone' => ['required', 'string',  'min:10', 'unique:clients'],
                'subscription' => ['required']
            ]
        );
        $save_data = ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'subscription_id' => $request->subscription, 'password' => Hash::make($request->phone)];
        $client = Client::create($save_data);
        if ($client) {
            return redirect('admin/clients')->with('success', "Client Added Successfully.");
        } else {
            return redirect('admin/clients')->with('failure', "Oops! Client Not added.");
        }
    }
}
