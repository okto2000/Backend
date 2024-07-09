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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer');
            $table->foreignId('id_product');
            $table->number('price');
            $table->date('transaction_date');
            $table->enum('status', ['belum dibayar','sedang diproses','dibayar']);
            $table->timestamps();
            
            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_product')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
