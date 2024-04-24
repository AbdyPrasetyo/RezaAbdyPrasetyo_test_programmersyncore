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
        Schema::create('training', function (Blueprint $table) {
            $table->id('id_training');
            $table->foreignId('id_biodata')->reference('id_biodata')->on('biodata')->onDelete('cascade');
            // $table->foreignId('user_id')->reference('id')->on('users')->onDelete('cascade');
            $table->string('nama_pelatihan');
            $table->string('penyelenggara');
            $table->date('tanggal_pelatihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training');
    }
};
