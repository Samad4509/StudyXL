<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();

            // Basic (from users table)
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('destination')->nullable();
            $table->string('study_level')->nullable();
            $table->string('subject')->nullable();
            $table->string('nationality')->nullable();
            $table->string('elp')->nullable();
            $table->string('passport')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();

            // New fields
            $table->string('gender')->nullable();

            // Passport / Identity
            $table->string('passport_number', 100)->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('country_of_residence', 100)->nullable();

            // Program Details
            $table->string('program')->nullable();
            $table->string('intake')->nullable();
            $table->string('specialization')->nullable();

            // Academic Qualification
            $table->string('qualification')->nullable();
            $table->string('institution')->nullable();
            $table->string('year')->nullable();
            $table->string('cgpa')->nullable();

            // Test Scores
            $table->string('test_name')->nullable();
            $table->string('test_score')->nullable();
            $table->string('test_year')->nullable();

            // Work Experience
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();

            // References
            $table->string('reference_name')->nullable();
            $table->string('reference_email')->nullable();
            $table->string('reference_relationship')->nullable();
            $table->string('reference_phone')->nullable();

            // Statement of Purpose
            $table->longText('sop')->nullable();

            // Extracurricular
            $table->text('achievements')->nullable();

            // Attachments
            $table->string('resume')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('transcripts')->nullable();
            $table->string('english_test')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
