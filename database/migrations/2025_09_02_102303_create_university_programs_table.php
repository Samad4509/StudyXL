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
       Schema::create('university_programs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->string('program_name');
            $table->text('program_description');
            $table->string('program_level')->nullable();
            $table->string('program_intakes')->nullable();
            $table->date('open_date')->nullable();
            $table->dateTime('submission_deadline')->nullable();

            // Student Requirements
            $table->string('study_permit_or_visa')->nullable();
            $table->string('nationality')->nullable();
            $table->string('education_country')->nullable();
            $table->string('last_level_of_study')->nullable();
            $table->string('grading_scheme')->nullable();

            // IELTS
            $table->boolean('ielts_required')->default(false);
            $table->float('ielts_reading')->nullable();
            $table->float('ielts_writing')->nullable();
            $table->float('ielts_listening')->nullable();
            $table->float('ielts_speaking')->nullable();
            $table->float('ielts_overall')->nullable();

            // TOEFL
            $table->boolean('toefl_required')->default(false);
            $table->integer('toefl_reading')->nullable();
            $table->integer('toefl_writing')->nullable();
            $table->integer('toefl_listening')->nullable();
            $table->integer('toefl_speaking')->nullable();
            $table->integer('toefl_overall')->nullable();

            // Duolingo
            $table->boolean('duolingo_required')->default(false);
            $table->integer('duolingo_total')->nullable();

            // PTE
            $table->boolean('pte_required')->default(false);
            $table->integer('pte_reading')->nullable();
            $table->integer('pte_writing')->nullable();
            $table->integer('pte_listening')->nullable();
            $table->integer('pte_speaking')->nullable();
            $table->integer('pte_overall')->nullable();

            // No Exam
            $table->string('no_exam_status')->nullable();

            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_programs');
    }
};
