<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('main_dealer', function (Blueprint $table) 
        {
            $table->id();
            $table->string('id_main')->unique();
            $table->string('nama_main');
            $table->string('alamat');
            $table->string('notelp');
            $table->string('email');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('main_dealer');
    }
};

