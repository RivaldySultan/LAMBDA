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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('nip', 30)->unique()->nullable()->after('username');
            $table->string('jabatan')->nullable()->after('nip');
            $table->enum('role', ['admin', 'pegawai'])->default('pegawai')->after('jabatan');
            $table->string('tanda_tangan')->nullable()->after('role');
            $table->boolean('is_active')->default(true)->after('tanda_tangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'nip', 'jabatan', 'role', 'tanda_tangan', 'is_active']);
        });
    }
};
