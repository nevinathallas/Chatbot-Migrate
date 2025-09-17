<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('service_variant', function (Blueprint $table)
        {
            $table->id();
            $table->integer('service_id');
            $table->unsignedBigInteger('variant_id');
            $table->timestamps();

            $table->foreign('service_id')->references('id_servis')->on('service')->onDelete('cascade');
            $table->foreign('variant_id')->references('id')->on('variant')->onDelete('cascade');

            $table->unique(['service_id', 'variant_id']);

        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('service_variant');
    }
};
