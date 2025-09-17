<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Variant;

class VariantSeeder extends Seeder
{
    public function run()
    {
        Variant::create([
            'Status_type' => 'ACTIVE',
            'var' => 3,
            'color' => 'Pearl White',
            'status_id' => 1,
            'id_model' => 1
        ]);
    }
}