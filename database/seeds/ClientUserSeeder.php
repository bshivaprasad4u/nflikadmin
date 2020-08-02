<?php

use App\Channel;
use Illuminate\Database\Seeder;
use App\Client;
use App\ClientsSubscriptions;
use Carbon\Carbon;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Client::where('email', 'client@nflik.com')->first()) {
            $client = Client::create([
                'name' => 'Client',
                'email' => 'client@nflik.com',
                'phone' => '1234567890',
                'password' => bcrypt('client@123'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            ClientsSubscriptions::create([
                'client_id' => $client->id,
                'subscription_id' => 1,

            ]);
            Channel::create([
                'client_id' => $client->id,
            ]);
        }
        if (!Client::where('email', 'agent@nflik.com')->first()) {
            Client::create([
                'name' => 'Agent',
                'email' => 'agent@nflik.com',
                'phone' => '2234567890',
                'password' => bcrypt('agent@123'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'parent_id' => 1
            ]);
        }
    }
}
