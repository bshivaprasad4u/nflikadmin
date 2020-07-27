<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Eloquent\Model;
use App\Admin;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Admin::where('email', 'admin@nflik.com')->first()) {
            Admin::create([
                'name' => 'admin',
                'email' => 'admin@nflik.com',
                'password' => bcrypt('admin@123')
            ]);
        }
    }
}
