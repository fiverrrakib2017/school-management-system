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
        Schema::create('student_exam_routines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('subject_id');

            // Written
            $table->boolean('has_written')->default(false);
            $table->decimal('written_full')->nullable();
            $table->decimal('written_pass')->nullable();

            // Objective
            $table->boolean('has_objective')->default(false);
            $table->decimal('objective_full')->nullable();
            $table->decimal('objective_pass')->nullable();

            // Practical
            $table->boolean('has_practical')->default(false);
            $table->decimal('practical_full')->nullable();
            $table->decimal('practical_pass')->nullable();

            $table->date('exam_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('room_number');
            $table->string('invigilator')->nullable();
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('student_exams')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('student_classes')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('student_subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_routines');
    }
};
