<?php

use Illuminate\Database\Seeder;

class Portfolio_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Portfolio_type::insert([
            [
                'id' => 'L',
                'name' => 'Lamaran',
            ],
            [
                'id' => 'preW',
                'name' => 'Pre Wedding',
            ],
            [
                'id' => 'W',
                'name' => 'Wedding',
            ],
            [
                'id' => 'S',
                'name' => 'Siraman/Pengajian',
            ]
        ]);
    }
}
