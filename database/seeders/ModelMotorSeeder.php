<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModelMotor;

class ModelMotorSeeder extends Seeder
{
    public function run()
    {
        ModelMotor::create([
            'id_model' => 1,
            'kategori' => 'Scooter',
            'nama_model' => 'PCX 160',
            'is_import' => false,
            'bike_code' => 'PCX160'
        ]);
    }
}