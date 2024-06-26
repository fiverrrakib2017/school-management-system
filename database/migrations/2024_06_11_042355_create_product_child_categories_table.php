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
        Schema::create('product_child_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_cat_id');
            $table->string('name');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('category_id')
            ->on('product__categories')
            ->references('id')
            ->onDelete('cascade');

            $table->foreign('sub_cat_id')
            ->on('product_sub_categories')
            ->references('id')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_child_categories');
    }
};
