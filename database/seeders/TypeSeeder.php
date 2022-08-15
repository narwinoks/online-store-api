<?php

namespace Database\Seeders;

use App\Models\Api\Address\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Type();
        $model->create([
            'name' => 'kantor'
        ]);
        $model->create([
            'name' => 'Rumah'
        ]);
    }
}
