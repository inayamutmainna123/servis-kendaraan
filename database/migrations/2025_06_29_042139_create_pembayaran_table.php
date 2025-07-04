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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('service_item_id');
            $table->foreignUlid('produk_id');
            $table->double('total_bayar');
            $table->double('kembalian');
            $table->datetime('tanggal_pembayaran');
            $table->enum('metode_pembayaran', ['cash']) ->default('cash');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
