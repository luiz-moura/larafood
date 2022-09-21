<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Persistence\Eloquent\Models\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Bunisers',
            'url' => 'bunisers',
            'price' => 499.99,
            'description' => 'Plano Empresarial',
        ]);
    }
}
