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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email_address');
            $table->text('profile_image')->nullable();
            $table->string('phone_number');
            $table->string('emergency_contract');
            $table->string('city');
            $table->string('state');
            $table->text('address');
            $table->date('dob');
            $table->integer('gender');
            $table->text('marital_status');
            $table->tinyInteger('verification_status')->default(0);
            $table->longText('verification_info')->nullable();
            $table->double('opening_balance', 20, 2)->default(0.00);
            $table->string('bank_name')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->integer('bank_routing_no')->nullable();
            $table->integer('bank_payment_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
