<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AlgorithmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Portoflio types table
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

        //User roles table
        \App\User_role::insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'name_text' => null,
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'name_text' => null,
            ]
        ]);

        //Users table
        \App\User::insert([
            [
                'name' => 'Mamoto Super Admin',
                'role_id' => 1,
                'username' => 'admin',
                'password' => bcrypt('mamoto1234'),
            ],
            [
                'name' => 'Rizki',
                'role_id' => 2,
                'username' => 'rizki',
                'password' => bcrypt('password'),
            ]
        ]);

        //Company Jumbotrons table
        \App\Company_jumbotron::insert([
            [
                'id' => 1,
                'path' => null,
                'name' => 'jumbotron1',
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'path' => null,
                'name' => 'jumbotron2',
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'path' => null,
                'name' => 'jumbotron3',
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'path' => null,
                'name' => 'jumbotron4',
                'date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        //Displayed Portfolio
        \App\Displayed_portfolio::insert([
            [
                'id' => 1,
                'portfolio_id' => null,
                'pfType_id' => 'W',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'portfolio_id' => null,
                'pfType_id' => 'preW',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'portfolio_id' => null,
                'pfType_id' => 'S',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'portfolio_id' => null,
                'pfType_id' => 'L',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);

        //Displayed Feedback
        \App\Displayed_feedback::insert([
            [
                'id' => 1,
                'feedback_id' => null,
                'photo_path' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'feedback_id' => null,
                'photo_path' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'feedback_id' => null,
                'photo_path' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'feedback_id' => null,
                'photo_path' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
