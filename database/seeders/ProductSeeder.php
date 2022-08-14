<?php

namespace Database\Seeders;

use App\Models\Api\Products\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Product();
        $model->create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'BAJU HIJRAH ORIGINAL SHIFT',
            'slug' => 'baju-hijrah-original-shift',
            'Summary' => 'BAJU HIJRAH ORIGINAL SHIFT',
            'sku' => 10,
            'price' => 80000,
            'discount' => 0,
            'quantity' => 10,
            'shop' => 1,
            'content' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',
            'publishedAt' => Carbon::today(),
            'startAt' => Carbon::today(),
            'endAt' => Carbon::today(),
        ]);
        $model->create([
            'user_id' => 1,
            'category_id' => 1,
            'title' => 'BAJU HIJRAH ORIGINAL SHIFT',
            'slug' => 'baju-hijrah-original-shift',
            'Summary' => 'BAJU HIJRAH ORIGINAL SHIFT',
            'sku' => 10,
            'price' => 80000,
            'discount' => 0,
            'quantity' => 10,
            'shop' => 1,
            'content' => 'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content. Lorem ipsum may be used as a placeholder before final copy is available.',
            'publishedAt' => Carbon::today(),
            'startAt' => Carbon::today(),
            'endAt' => Carbon::today(),
        ]);
    }
}
