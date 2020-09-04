<?php

namespace App\Http\Controllers\Admin;

use App\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Client;
use App\User;
use App\ClientsSubscriptions;
use App\Channel;
use Illuminate\Support\Str;
use App\Events\CreateClientEvent;
use App\SubscriptionUser;

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
        $data['clients'] = Client::all()->whereNull('parent_id')->sortByDesc('created_at');
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
        $data['subscriptions'] = Subscription::all()->sortBy('id');
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:clients', 'unique:users'],
                'phone' => ['required', 'string',  'min:10', 'unique:clients', 'unique:users,mobile'],
                'subscription' => ['required'],
                'subdomain' => 'sometimes|nullable|alpha_num',
                'slot_duration' => 'sometimes|nullable|integer',

            ]
        );
        $password = Str::random(8);
        $save_data = ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => Hash::make($password), 'slot_duration' => $request->slot_duration];
        //$save_data = ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => Hash::make($request->phone), 'slot_duration' => $request->slot_duration];
        $client = Client::create($save_data);

        $user = User::create(['name' => $request->name, 'email' => $request->email, 'mobile' => $request->phone, 'password' => $password]);

        $subscription = SubscriptionUser::create(
            [
                'client_id' => $client->id,
                'subscription_id' => $request->subscription,
                'expires_at' => now()->addYear(),
                'user_id' => $user->id
            ]
        );
        // ClientsSubscriptions::create(
        //     [
        //         'client_id' => $client->id,
        //         'subscription_id' => $request->subscription,
        //     ]
        // );
        Channel::create([
            'client_id' => $client->id,
            'subdomain' => $request->subdomain
        ]);
        //$client->sendEmailVerificationNotification();
        $client->sendClientPasswordNotification($password);
        //event(new CreateClientEvent($client, $password));

        if ($client) {
            return redirect('admin/clients')->with('success', "Client Added Successfully.");
        } else {
            return redirect('admin/clients')->with('failure', "Oops! Client Not added.");
        }
    }
}
