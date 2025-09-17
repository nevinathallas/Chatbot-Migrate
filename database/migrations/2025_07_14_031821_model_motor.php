<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('model_motor', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('id_model')->unique();
            $table->string('kategori', 50);
            $table->string('nama_model', 100);
            $table->boolean('is_import')->default(false);
            $table->string('bike_code', 20);
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('model_motor');
    }
};

