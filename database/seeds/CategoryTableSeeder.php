<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
#use Illuminate\Database\Eloquent\Model;
use App\Category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #DB::table('categories')->truncate();
        Category::truncate();
        $categories = [
            [
                'name' => 'Entertainment',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Education',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],
            [
                'name' => 'Live Events',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Web Series',
                'status' => 'active',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]

        ];
        #DB::table('categories')->insert($categories);
        Category::insert($categories);
    }
}
