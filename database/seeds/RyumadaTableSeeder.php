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
        // books_packages table seeder
        \App\Books_package::insert([
            [
                'id' => 'preW',
                'budgets' => '[{"name":"Chocolate","price":"2500"},{"name":"Vanilla","price":"3500"},{"name":"Cream","price":"6000"}]',
            ],
            [
                'id' => 'W',
                'budgets' => '[{"name": "Basic", "price": "7500"}, {"name": "Medium", "price": "11500"}, {"name": "Exclusive", "price": "22500"}, {"name": "Custom", "price": "5000"}]',
            ],
            [
                'id' => 'S',
                'budgets' => '[{"name":"Tulip","price":"4500"}]',
            ]
        ]);

        // company_about table seeder
        DB::table('company_about')->insert([
            'id' => 0,
            'post' => 'Mamoto Pictures.',
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
    }
}
