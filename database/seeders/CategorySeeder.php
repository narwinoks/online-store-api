<?php

namespace Database\Seeders;

use App\Models\Api\Products\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $model = new Category();

        $model->create([
            'parent_id' => null,
            'title' => 'Baju Anak',
            'slug' => 'baju-anak',
            'content' => 'cocok untuk baju anak',
        ]);
        $model->create([
            'parent_id' => null,
            'title' => 'Baju Dewassa',
            'slug' => 'baju-anak',
            'content' => 'cocok untuk baju dewasa',
        ]);
        $model->create([
            'parent_id' => 1,
            'title' => 'Baju Anak Cowok',
            'slug' => 'baju-anak-cowok',
            'content' => 'cocok untuk baju anak',
        ]);
    }
}
