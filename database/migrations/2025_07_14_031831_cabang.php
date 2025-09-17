<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('id_dealer')->unique();
            $table->string('id_main');
            $table->foreign('id_main')
                ->references('id_main')
                ->on('main_dealer')
                ->onDelete('cascade');
            $table->string('nama_dealer');
            $table->enum('jenis_dealer', ['DEALER','AHASS']);
            $table->string('notelp_dealer', 100);
            $table->string('email_dealer');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};

