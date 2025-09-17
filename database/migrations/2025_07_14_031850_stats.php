<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        
        
        Schema::create("stats", function (Blueprint $table) 
        {
            $table->id();
            $table->integer('status_id')->unique();
            $table->boolean('is_import')->default(false);
            $table->timestamps();
        });   

    }

    
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
