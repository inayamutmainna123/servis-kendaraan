<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranServiceTable extends Migration
{
    public function up()
    {
        Schema::create('pembayaran_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembayaran_id')->nullable();
            $table->foreignId('service_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_service');
    }
}
