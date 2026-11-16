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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_profile_id')->constrained()->cascadeOnDelete();
            $table->string('nama_produk', 150);
            $table->string('foto')->nullable();
            $table->unsignedInteger('stok')->default(0);
            $table->decimal('harga_asli', 12, 2);
            $table->decimal('harga_diskon', 12, 2);
            $table->string('titik_penjemputan');
            $table->dateTime('batas_waktu_konsumsi');
            $table->enum('status', ['tersedia', 'habis', 'kadaluarsa', 'nonaktif'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
