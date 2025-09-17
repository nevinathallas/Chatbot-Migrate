<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Variant;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MainDealerSeeder::class,
            ServiceSeeder::class,
            ModelMotorSeeder::class,
            VariantSeeder::class,
            // Add other seeders in dependency order
        ]);
    }
}




