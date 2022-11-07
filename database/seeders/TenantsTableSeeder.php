<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Persistence\Eloquent\Models\Plan;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::first()->tenants()->create([
            'cnpj' => '65.462.943/0001-81',
            'name' => 'Limited intelligence',
            'url' => 'limitedintelligence',
            'email' => 'limitedintelligences@test.com.br',
        ]);
    }
}
