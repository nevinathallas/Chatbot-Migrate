<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('specs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_specs')->unique();
            $table->integer('id_motorcycle');
            $table->timestamps();

            $table->foreign('id_motorcycle')
                ->references('id_motorcycle')
                ->on('Motor')
                ->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('specs');
    }
};
