<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // contacts table seeder
        DB::table('contacts')->insert(
            [
                [
                    'name' => 'whatsapp',
                    'contact' => '6281281828317',
                    'link' => 'https://wa.me/',
                    'text' => 'Whatsapp Admin Lusi',
                    'logo' => 'fab fa-whatsapp',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'whatsapp1',
                    'contact' => '6281288368000',
                    'link' => 'https://wa.me/',
                    'text' => 'Whatsapp Admin Mull',
                    'logo' => 'fab fa-whatsapp',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'whatsapp2',
                    'contact' => '6281292245688',
                    'link' => 'https://wa.me/',
                    'text' => 'Whatsapp Admin Yusra',
                    'logo' => 'fab fa-whatsapp',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'bridestory',
                    'contact' => 'mamotopicture',
                    'link' => 'https://www.bridestory.com/',
                    'text' => 'Bridestory',
                    'logo' => 'fab fa-camera',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'instagram',
                    'contact' => 'mamotopicture',
                    'link' => 'https://www.instagram.com/',
                    'text' => 'Instagram',
                    'logo' => 'fab fa-instagram',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'facebook',
                    'contact' => 'mamotopicture',
                    'link' => 'https://www.facebook.com/',
                    'text' => 'Facebook',
                    'logo' => 'fa fa-facebook-f',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'youtube',
                    'contact' => 'UCheVKImQlhnox9i9KM3nZ7w',
                    'link' => 'https://www.youtube.com/channel/',
                    'text' => 'Youtube Channel',
                    'logo' => 'fab fa-youtube',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'website',
                    'contact' => 'mamotopictures.com',
                    'link' => 'https://',
                    'text' => 'Visit Website',
                    'logo' => 'fa fa-globe',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'email',
                    'contact' => 'mamotopicture@gmail.com',
                    'link' => 'mailto:',
                    'text' => 'Contact via Email',
                    'logo' => 'fa fa-envelope',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
