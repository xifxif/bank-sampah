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
        Schema::create('bank_sampah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->string('kode_bank', 20)->unique();
            $table->string('nama_bank', 100);
            $table->text('alamat');
            $table->string('no_telepon', 20)->nullable();
            $table->string('nama_pengelola', 100);
            $table->string('email', 100)->nullable();
            $table->date('tanggal_berdiri')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'pending'])->default('aktif');
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_sampah');
    }
};
