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
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('destination')->nullable();
            $table->string('study_level')->nullable();
            $table->string('subject')->nullable();
            $table->string('nationality')->nullable();
            $table->string('passport')->nullable();
            $table->string('elp')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('country_of_residence', 100)->nullable();
            $table->string('program')->nullable();
            $table->string('intake')->nullable();
            $table->string('specialization')->nullable();

            // JSON fields
           $table->json('academic_qualifications')->nullable();
            $table->json('test_scores')->nullable();
            $table->json('work_experiences')->nullable();
            $table->json('references')->nullable();

            // SOP, achievements, attachments
            $table->longText('sop')->nullable();
            $table->text('achievements')->nullable();
            $table->string('resume')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('transcripts')->nullable();
            $table->string('english_test')->nullable();
            $table->string('photo')->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
