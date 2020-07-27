<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");
        $this->call(CategoryTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(ClientUserSeeder::class);
    }
}
