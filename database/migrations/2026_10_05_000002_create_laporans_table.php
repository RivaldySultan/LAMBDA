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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            
            // Rentang waktu & uraian aktivitas 1 s/d 6
            $table->string('waktu_1')->nullable();
            $table->text('kegiatan_1')->nullable();
            
            $table->string('waktu_2')->nullable();
            $table->text('kegiatan_2')->nullable();
            
            $table->string('waktu_3')->nullable();
            $table->text('kegiatan_3')->nullable();
            
            $table->string('waktu_4')->nullable();
            $table->text('kegiatan_4')->nullable();
            
            $table->string('waktu_5')->nullable();
            $table->text('kegiatan_5')->nullable();
            
            $table->string('waktu_6')->nullable();
            $table->text('kegiatan_6')->nullable();
            
            // Bukti visual / foto selfie perjalanan & kegiatan lapangan
            $table->string('foto_bukti_1')->nullable();
            $table->string('keterangan_foto_1')->nullable();
            
            $table->string('foto_bukti_2')->nullable();
            $table->string('keterangan_foto_2')->nullable();
            
            // Geotagging GPS
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('lokasi_keterangan')->nullable();
            
            // Status verifikasi laporan
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('submitted');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('diverifikasi_pada')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
