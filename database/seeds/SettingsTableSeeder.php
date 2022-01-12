<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* --------------------------- settings for promo --------------------------- */
        // seeder nomor telpon promo
        \App\Setting::insert([
          // [
          //     'module_name' => 'promo',
          //     'setting_name' => 'promo_waNumber',
          //     'setting_value' => '6285289675777',
          //     'created_at' => Carbon::now(),
          //     'updated_at' => Carbon::now()
          // ],
          // [
          //     'module_name' => 'contact',
          //     'setting_name' => 'contactFloatingButton_text',
          //     'setting_value' => "",
          //     'created_at' => Carbon::now(),
          //     'updated_at' => Carbon::now()
          // ],
      ]);
    }
}
