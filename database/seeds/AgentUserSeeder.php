<?php

use Illuminate\Database\Seeder;
use App\Client;
use Carbon\Carbon;

class AgentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Client::where('email', 'agent@nflik.com')->first()) {
            Client::create([
                'name' => 'Agent',
                'email' => 'agent@nflik.com',
                'phone' => '2234567890',
                'password' => bcrypt('agent@123'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'parent_id' => 1,
            ]);
        }
    }
}
