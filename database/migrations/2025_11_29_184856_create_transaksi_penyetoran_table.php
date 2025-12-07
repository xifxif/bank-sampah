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
        Schema::create('transaksi_penyetoran', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi', 50)->unique();
            $table->foreignId('bank_sampah_id')->constrained('bank_sampah')->onDelete('cascade');
            $table->foreignId('jenis_sampah_id')->constrained('jenis_sampah')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Operator yang input
            $table->date('tanggal_setor');
            $table->string('nama_penyetor', 100);
            $table->string('no_identitas', 50)->nullable();
            $table->decimal('berat', 15, 2); // dalam satuan sesuai jenis sampah
            $table->decimal('harga_per_satuan', 15, 2);
            $table->decimal('subtotal', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Index untuk performa query
            $table->index('tanggal_setor');
            $table->index('bank_sampah_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_penyetoran');
    }
};
