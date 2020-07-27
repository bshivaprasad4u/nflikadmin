<?php

use Illuminate\Database\Seeder;
use App\Client;
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
        if (!Client::where('email', 'admin@nflik.com')->first()) {
            Client::create([
                'name' => 'Client',
                'email' => 'client@nflik.com',
                'phone' => '1234567890',
                'password' => bcrypt('client@123'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'subscription_id' => 1,
            ]);
        }
    }
}
