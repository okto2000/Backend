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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_transaction');
            $table->foreignId('id_product');
            $table->decimal('price', 8, 2);
            $table->integer('qty');
            $table->date('transaction_date');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_transaction')->references('id')->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
