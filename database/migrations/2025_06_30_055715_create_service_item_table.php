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
        Schema::create('service_item', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('costumer_id');
            $table->foreignUlid('service_id');
            $table->foreignUlid('produk_id');
            $table->string('tipe_kendaraan');
            $table->string('merek_kendaraan');
            $table->string('model_kendaraan');   
            $table->string('plat_no_kendaraan');
            $table->text('catatan');
            $table->enum('status', ['sedang diperbaiki','selesai diperbaiki'] )->default('sedang diperbaiki');
            $table->datetime('tangggal_service');
            $table->datetime('tangggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_item');
    }
};
