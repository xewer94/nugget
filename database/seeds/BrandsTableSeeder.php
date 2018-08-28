<?php

use Carbon\Carbon;
use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Brand::insert([
            ['name' => 'Festina', 'slug' => 'festina', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fossil', 'slug' => 'fossil', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Diesel', 'slug' => 'diesel', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Boss', 'slug' => 'boss', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Guess', 'slug' => 'guess', 'created_at' => $now, 'updated_at' => $now],
        
        ]);
    }
}
