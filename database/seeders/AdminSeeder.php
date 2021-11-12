<?php

namespace Database\Seeders;

use App\Models\Admin;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        Admin::create([
            'name' => $faker->name(),
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    }
}
