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
            'post' => 'Mamoto Pictures.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // contacts table seeder
        DB::table('contacts')->insert(
            // PRODUCTION cek contact dengan kesesuaian mamoto
            [
                [
                    'name' => 'email',
                    'contact' => 'contact@mamotopicture.com',
                    'logo' => 'fa fa-envelope',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'facebook',
                    'contact' => 'mamotopicture',
                    'logo' => 'fa fa-facebook-f',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'instagram',
                    'contact' => '@mamotopicture',
                    'logo' => 'fa fa-instagram',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'website',
                    // PRODUCTION change website domain
                    'contact' => 'https://mamotopictures.com',
                    'logo' => 'fa fa-globe',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'whatsapp',
                    // PRODUCTION change whatsapp number
                    'contact' => '6285289675777',
                    'logo' => 'fa fa-whatsapp',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'youtube',
                    // PRODUCTION change youtube channel to link
                    'contact' => 'mamotopicture',
                    'logo' => 'fa fa-youtube',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]
        );

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

        /* -------------------------- settings for contact -------------------------- */
        // pesan link wa 
        DB::table('settings')->insert(
            [
                [
                    'module_name' => 'contact',
                    'setting_name' => 'wa_link',
                    'setting_value' => "https://wa.me/",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'module_name' => 'contact',
                    'setting_name' => 'yt_link',
                    'setting_value' => "https://www.youtube.com/c/",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]
        );

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
    }
}
