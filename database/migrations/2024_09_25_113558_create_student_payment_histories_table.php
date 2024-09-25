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
        Schema::create('student_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id');
            $table->date('payment_date');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method', 50)->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('bill_id')->references('id')->on('student_bill_collections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_payment_histories');
    }
};
