<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'id_servis' => 1,
            'desc' => 'Regular Service',
            'syarat' => 'Vehicle must be under warranty',
            'masa_berlaku' => '2025-12-31',
            'notes' => 'Standard maintenance service',
            'id_main' => 'MD001' 
        ]);
    }
}
