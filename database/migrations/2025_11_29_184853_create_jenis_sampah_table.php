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
        Schema::create('jenis_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jenis', 20)->unique();
            $table->string('nama_jenis', 100);
            $table->enum('kategori', ['organik', 'anorganik', 'b3'])->default('anorganik');
            $table->string('satuan', 20)->default('kg'); // kg, pcs, unit
            $table->decimal('harga_standar', 15, 2)->default(0); // Harga standar dari DLH
            $table->text('keterangan')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_sampah');
    }
};
