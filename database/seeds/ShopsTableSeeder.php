<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
          [
            'title' => 'shop one',
            'region_id' => 1,
            'city' => 'city one',
            'address' => 'city 1, street 1, building 1',
            'user_id' => 1,
          ],
          [
            'title' => 'shop two',
            'region_id' => 2,
            'city' => 'city two',
            'address' => 'city 2, street 2, building 2',
            'user_id' => 2,
          ],
          [
            'title' => 'shop three',
            'region_id' => 3,
            'city' => 'city three',
            'address' => 'city 3, street 3, building 3',
            'user_id' => 3,
          ]
        ]);
    }
}
