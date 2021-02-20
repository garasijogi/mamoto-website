<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // counter for promo
        DB::table('counters')->insert([
            'name' => 'promo',
            'count' => 0,
            'attribute' => json_encode(array(
                'year' => date('Y')
            )),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /* --------------------------- settings for promo --------------------------- */
        // seeder nomor telpon promo
        DB::table('settings')->insert([
            'module_name' => 'promo',
            'setting_name' => 'promo_waNumber',
            // PRODUCTION ubah nomor telpon
            'setting_value' => '6285289675777',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // pesan link wa 
        DB::table('settings')->insert([
            'module_name' => 'contact',
            'setting_name' => 'wa_link',
            // PRODUCTION ubah nomor telpon
            'setting_value' => "https://wa.me/",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
