<?php

use Illuminate\Database\Seeder;

class User_rolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
