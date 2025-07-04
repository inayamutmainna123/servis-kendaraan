<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranProdukTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->nullable();
            $table->foreignId('produk_id')->nullable();
            $table->double('jumlah_barang')->default(1); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_produk');
    }
}

