<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('motor', function (Blueprint $table) {
            $table->id();
            $table->integer('id_motorcycle')->unique();
            $table->string('model_kode', 50);
            $table->integer('var');
            $table->string('warna', 50);
            $table->enum('status_vr', ['ACTIVE', 'INACTIVE']);
            $table->timestamps();

            $table->foreign('id_motorcycle')
                ->references('id_model')
                ->on('model_motor')
                ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('motor');
    }
};
