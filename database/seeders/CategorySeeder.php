<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Root',
            'description' => 'This is the root category. dont\'t delete this one',
            'parent_id' => null,
            'menu' => 0,
        ]);

        Category::factory()
            ->count(3)
            ->create();
    }
}
