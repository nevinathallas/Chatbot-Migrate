<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create("brosur", function (Blueprint $table) {
            $table->id();
            $table->integer('id_brosur')->unique();
            $table->integer('id_motorcycle');
            $table->text('isi');
            $table->timestamps();

            $table->foreign('id_motorcycle')
                ->references('id_motorcycle')
                ->on('motor')
                ->onDelete('cascade');
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('brosur');
    }
};
