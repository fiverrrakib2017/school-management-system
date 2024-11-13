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
        Schema::create('customer__invoices', function (Blueprint $table) {
            $table->id();
            $table->text('transaction_number')->nullable();
            $table->integer('usr_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->date('invoice_date');
            $table->decimal('sub_total', 10, 0);
            $table->decimal('discount', 10, 0);
            $table->decimal('grand_total', 10, 0);
            $table->decimal('due_amount');
            $table->decimal('paid_amount');
            $table->text('note')->nullable();
            $table->integer('status')->comment('0=Draf,1=Completed');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer__invoices');
    }
};
