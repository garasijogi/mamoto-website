<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
