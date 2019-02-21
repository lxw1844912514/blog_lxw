<?php

use Illuminate\Database\Seeder;

class FlightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('flights')
            ->insert([
               'name'=>str_random(10),
                'airline'=>str_random(10).'@qq.com',
            ]);
    }
}
