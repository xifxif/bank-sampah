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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('bank_sampah_id')->nullable()->constrained('bank_sampah')->onDelete('set null');
            $table->string('aktivitas', 100); // create, update, delete, login, etc
            $table->string('modul', 50); // user, bank_sampah, transaksi_penyetoran, dll
            $table->text('deskripsi');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->json('data_lama')->nullable(); // Data sebelum perubahan
            $table->json('data_baru')->nullable(); // Data setelah perubahan
            $table->timestamps();

            // Index untuk performa query
            $table->index('user_id');
            $table->index('bank_sampah_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
