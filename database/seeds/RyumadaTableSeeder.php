<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RyumadaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // company_about table seeder
        DB::table('company_about')->insert([
            'id' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
