<?php

namespace Database\Seeders;

use App\Models\Api\Products\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Color();
        $model->create([
            'color' => 'BLUE',
            'code_Color' => '808000'
        ]);
        $model->create([
            'color' => 'BLACK',
            'code_Color' => '000000'
        ]);
    }
}
