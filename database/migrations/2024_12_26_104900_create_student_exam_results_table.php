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
        Schema::create('student_exam_results', function (Blueprint $table) {
            $table->id();

            $table->integer('is_absent')->default(0);

            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');

            $table->decimal('practical_marks', 8, 2)->nullable();
            $table->decimal('objective_marks', 8, 2)->nullable();
            $table->decimal('written_marks', 8, 2)->nullable();
            $table->decimal('total_marks', 8, 2)->default(0);
            $table->decimal('highest_marks', 8, 2)->nullable();

            $table->string('grade')->nullable();
            $table->decimal('point', 4, 2)->nullable();

            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('exam_id')->references('id')->on('student_exams')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('student_classes')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('student_subjects')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_results');
    }
};
