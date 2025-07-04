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
        // database/migrations/xxxx_xx_xx_create_invoices_table.php
    Schema::create('invoices', function (Blueprint $table) {
        $table->ulid('id')->primary();
        $table->string('invoice_number')->unique();
        $table->date('invoice_date');
        $table->string('customer_name');
        $table->string('customer_email')->nullable();
        $table->double('total')->default(0);
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
