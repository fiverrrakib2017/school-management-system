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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('current_address');
            $table->string('permanent_address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->unsignedBigInteger('current_class');
            $table->string('previous_school')->nullable();
            $table->unsignedBigInteger('previous_class')->nullable();
            $table->string('academic_results')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('health_conditions')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('previous_class')
            ->on('student_classes')
            ->references('id')
            ->onDelete('cascade');

            $table->foreign('current_class')
            ->on('student_classes')
            ->references('id')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
