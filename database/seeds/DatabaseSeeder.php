<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AlgorithmTableSeeder::class);
        $this->call(RyumadaTableSeeder::class);

        // per module seeder
        $this->call(ContactSeeder::class);
    }
}
