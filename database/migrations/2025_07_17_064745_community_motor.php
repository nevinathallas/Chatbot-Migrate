<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('community_motor', function (Blueprint $table) 
        {
            $table->id();
            $table->unsignedBigInteger('community_id');
            $table->integer('motor_id');
            $table->timestamps();

            $table->foreign('community_id')->references('id')->on('community')->onDelete('cascade');
            $table->foreign('motor_id')->references('id_motorcycle')->on('motor')->onDelete('cascade');

            $table->unique(['community_id', 'motor_id']);
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('community_motor');
    }
};
