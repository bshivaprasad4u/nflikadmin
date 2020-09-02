<?php

use App\Channel;
use Illuminate\Database\Seeder;
use App\Client;
use App\SubscriptionUser;
use App\User;

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
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $user = User::create([
                'name' => 'Client',
                'email' => 'client@nflik.com',
                'mobile' => '1234567890',
                'password' => 'client@123',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            SubscriptionUser::create([
                'client_id' => $client->id,
                'subscription_id' => 3,
                'expires_at' => now()->addYear(),
                'user_id' => $user->id

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
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'parent_id' => 1
            ]);
            $user = User::create([
                'name' => 'Agent',
                'email' => 'agent@nflik.com',
                'mobile' => '2234567890',
                'password' => 'agent@123',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
