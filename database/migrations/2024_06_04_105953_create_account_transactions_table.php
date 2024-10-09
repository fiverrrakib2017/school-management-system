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
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('type'); //asset, liablities,revenue,expense
            $table->text('refer_no');
            $table->text('description');
            $table->unsignedBigInteger('master_ledger_id');
            $table->unsignedBigInteger('ledger_id');
            $table->unsignedBigInteger('sub_ledger_id');
            $table->integer('qty');
            $table->integer('value');
            $table->integer('total');
            $table->timestamps();

            $table->foreign('master_ledger_id')->on('master_ledgers')
            ->references('id')
            ->onDelete('cascade');

            $table->foreign('ledger_id')->on('ledgers')
            ->references('id')
            ->onDelete('cascade');

            $table->foreign('sub_ledger_id')->on('sub_ledgers')
            ->references('id')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_transactions');
    }
};
