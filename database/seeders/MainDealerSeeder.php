<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MainDealer;

class MainDealerSeeder extends Seeder
{
    public function run()
    {
        MainDealer::create([
            'id_main' => 'MD001',
            'nama_main' => 'Honda Main Dealer',
            'alamat' => 'Jakarta',
            'notelp' => '021-1234567',
            'email' => 'honda@example.com'
        ]);
    }
}