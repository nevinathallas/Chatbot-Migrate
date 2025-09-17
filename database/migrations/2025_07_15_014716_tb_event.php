<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('tb_event', function (Blueprint $table) {
            $table->id();
            $table->integer('id_event')->unique();
            $table->string('nama_event');
            $table->date('tgl_data');
            $table->timestamps();
        });
    }


    public function down(): void
    {
       Schema::dropIfExists('tb_event');
    }
};
