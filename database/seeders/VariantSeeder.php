<?php

namespace Database\Seeders;

use App\Models\Api\Products\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variant = new Variant();
        $variant->create([
            'product_id' => 1,
            'color_id' => 1,
        ]);
        $variant->create([
            'product_id' => 1,
            'color_id' => 2,
        ]);
    }
}
