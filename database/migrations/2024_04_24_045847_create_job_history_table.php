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
        Schema::create('job_history', function (Blueprint $table) {

            $table->id('id_job_history');
            $table->foreignId('id_biodata')->reference('id_biodata')->on('biodata')->onDelete('cascade');
            // $table->foreignId('user_id')->reference('id')->on('users')->onDelete('cascade');
            $table->string('nama_perusahaan');
            $table->string('posisi');
            $table->year('tahun_mulai');
            $table->year('tahun_selesai')->nullable(); // Jika masih bekerja di sini, bisa jadi null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_history');
    }
};
