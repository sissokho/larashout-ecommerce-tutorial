<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::create([
            'code' => 'size',
            'name' => 'Size',
            'frontend_type' => 'select',
            'is_filterable' => 1,
            'is_required' => 1,
        ]);

        Attribute::create([
            'code' => 'color',
            'name' => 'Color',
            'frontend_type' => 'select',
            'is_filterable' => 1,
            'is_required' => 1,
        ]);
    }
}
