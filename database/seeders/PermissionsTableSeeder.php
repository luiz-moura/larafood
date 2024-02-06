<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Persistence\Eloquent\Models\Profile;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::first()->permissions()->createMany([
            ['name' => 'Tenants'],
            ['name' => 'Plans'],
            ['name' => 'Products'],
            ['name' => 'Tables'],
            ['name' => 'Categories'],
            ['name' => 'Profiles'],
            ['name' => 'Roles'],
            ['name' => 'Users']
        ]);
    }
}
