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
        Schema::create('harga_sampah_bank', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_sampah_id')->constrained('bank_sampah')->onDelete('cascade');
            $table->foreignId('jenis_sampah_id')->constrained('jenis_sampah')->onDelete('cascade');
            $table->decimal('harga', 15, 2);
            $table->date('tanggal_berlaku');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Unique constraint untuk menghindari duplikasi
            $table->unique(['bank_sampah_id', 'jenis_sampah_id', 'tanggal_berlaku'], 'unique_harga_bank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harga_sampah_bank');
    }
};
