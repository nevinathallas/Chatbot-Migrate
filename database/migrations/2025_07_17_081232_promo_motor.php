<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('promo_motor', function (Blueprint $table)
        {
        $table->id();
        $table->integer('motor_id');
        $table->unsignedBigInteger('promo_id');
        $table->timestamps();

        $table->foreign('motor_id')->references('id_motorcycle')->on('motor')->onDelete('cascade');
        $table->foreign('promo_id')->references('id')->on('promo')->onDelete('cascade');

        $table->unique(['promo_id', 'motor_id']);

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('promo_motor');
    }
};
