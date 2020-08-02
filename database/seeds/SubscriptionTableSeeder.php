<?php

use Illuminate\Database\Seeder;
#use App\Subscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriptions')->truncate();

        $subscriptions = [
            [
                'name' => 'Basic',
                'status' => 'active',
                'slots' => '1',
                'agents' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bronze',
                'status' => 'active',
                'slots' => '7',
                'agents' => '20',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Silver',
                'status' => 'active',
                'slots' => '15',
                'agents' => '50',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Gold',
                'status' => 'active',
                'slots' => '25',
                'agents' => '100',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Platinum',
                'status' => 'active',
                'slots' => '',
                'agents' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Diamond',
                'status' => 'active',
                'slots' => '',
                'agents' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'VVIP',
                'status' => 'active',
                'slots' => '',
                'agents' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];
        DB::table('subscriptions')->insert($subscriptions);
    }
}
