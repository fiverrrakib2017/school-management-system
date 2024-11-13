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
        Schema::create('customer__invoice__details', function (Blueprint $table) {
            $table->id();
            $table->text('transaction_number')->nullable();
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->decimal('price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->integer('status');
            $table->timestamps();

             $table->foreign('invoice_id')->references('id')->on('customer__invoices')->onDelete('cascade');
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer__invoice__details');
    }
};
