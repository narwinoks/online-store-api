<?php

namespace Database\Seeders;

use App\Models\Api\Products\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Size();
        $model->create([
            'name' => 'XL'
        ]);
        $model->create([
            'name' => 'S'
        ]);
        $model->create([
            'name' => 'M'
        ]);
        $model->create([
            'name' => 'L'
        ]);
    }
}
