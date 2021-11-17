<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        $sizes = ['small', 'medium', 'large'];
        $colors = ['black', 'blue', 'red', 'orange'];

        foreach ($sizes as $size) {
            AttributeValue::create([
                'attribute_id' => 1,
                'value' => $size,
                'price' => null,
            ]);
        }

        foreach ($colors as $color) {
            AttributeValue::create([
                'attribute_id' => 2,
                'value' => $color,
                'price' => null,
            ]);
        }
    }
}
