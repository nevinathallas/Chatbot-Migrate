<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        

        Schema::create('variant', function (Blueprint $table) 
        {
            $table->id();
            $table->enum('Status_type', ['ACTIVE','INACTIVE']);
            $table->integer('var');
            $table->string('color', 100);
            $table->integer('status_id');
            $table->integer('id_model');
            $table->timestamps();
        });

        
    }

    
    public function down(): void
    {
        Schema::dropIfExists('variant');
    }
};
