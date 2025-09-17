<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create("service", function (Blueprint $table) 
        {
            $table->id();
            $table->integer('id_servis')->unique();
            $table->text('desc');
            $table->text('syarat');
            $table->date('masa_berlaku');
            $table->text('notes');
            $table->string('id_main');
            $table->timestamps();

            $table->foreign('id_main')->references('id_main')->on('main_dealer')->onDelete('cascade');
        });


    }


    public function down(): void
    {
        Schema::dropIfExists('service');
    }
};

