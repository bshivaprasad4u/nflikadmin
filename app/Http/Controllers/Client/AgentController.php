<?php

namespace App\Http\Controllers\Client;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Client;

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
        $this->middleware('auth:client');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Agents';
        $data['agents'] = Client::all()->where('parent_id', Auth::id())->sortByDesc('created_at');
        return view('client.agent.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Agents';
        return view('client.agent.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['page_title'] = 'Agents';

        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
                'phone' => ['required', 'string',  'min:10', 'unique:clients'],
            ]
        );
        $save_data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->phone),
            'parent_id' => Auth::id()
        ];
        $client = Client::create($save_data)->sendEmailVerificationNotification();


        if ($client) {
            return redirect('client/agents')->with('success', "Agent Added Successfully.");
        } else {
            return redirect('client/agents')->with('failure', "Oops! Agent Not added.");
        }
    }
}
