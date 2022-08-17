<?php

namespace Database\Seeders;

use App\Models\Api\Products\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Item();
        $model->create([
            'size_id' => 1,
            'variant_id' => 1,
            'sku' => md5('j'),
            'price' => 200000,
            'discount' => 0,
            'quantity' => 1,
        ]);
        $model->create([
            'size_id' => 2,
            'variant_id' => 1,
            'sku' => md5('j'),
            'price' => 200000,
            'discount' => 0,
            'quantity' => 1,
        ]);
    }
}
