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
        Schema::create('zkteco_sms_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('sms_enable')->default(false);
            $table->boolean('on_present')->default(false);
            $table->boolean('on_absent')->default(false);
            $table->text('present_template')->nullable();
            $table->text('absent_template')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zkteco_sms_settings');
    }
};
