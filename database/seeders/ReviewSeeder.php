<?php

namespace Database\Seeders;

use App\Models\Api\Products\review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new review();
        $model->create([
            'user_id' => 1,
            'product_id' => 1,
            'title' => 'kualitas produk',
            'rating' => 4,
            'content' => 'kualitas produk sangat bangus dan baik'
        ]);
    }
}
