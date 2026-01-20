<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // পুরানো table drop
        Schema::dropIfExists('applications');

        // নতুন table create
        Schema::create('applications', function (Blueprint $table) {

            $table->id();

            // ===============================
            // Application Info
            // ===============================
            $table->string('student_name')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('agent_name')->nullable();
            $table->integer('agent_id')->nullable();
            $table->unsignedBigInteger('program_id')->nullable();
            $table->string('program_name')->nullable();
            $table->string('university_name')->nullable();
            $table->string('intake')->nullable();
            $table->enum('status', ['Submitted', 'Pending', 'Accepted', 'Rejected'])->default('Submitted');

            // ===============================
            // Program Details
            // ===============================
            $table->unsignedBigInteger('program_level_id')->nullable();
            $table->string('program_description')->nullable();
            $table->string('program_level')->nullable();
            $table->date('program_open_date')->nullable();
            $table->dateTime('program_submission_deadline')->nullable();
            $table->string('intake_name')->nullable();
            $table->unsignedBigInteger('field_of_study_id')->nullable();
            $table->string('field_of_study_name')->nullable();
            $table->string('study_permit_or_visa')->nullable();
            $table->string('program_nationality')->nullable();
            $table->string('education_country')->nullable();
            $table->string('last_level_of_study')->nullable();
            $table->string('grading_scheme')->nullable();

            // ===============================
            // English Requirements
            // ===============================
            $table->boolean('ielts_required')->default(false);
            $table->integer('ielts_reading')->nullable();
            $table->integer('ielts_writing')->nullable();
            $table->integer('ielts_listening')->nullable();
            $table->integer('ielts_speaking')->nullable();
            $table->float('ielts_overall')->nullable();

            $table->boolean('toefl_required')->default(false);
            $table->integer('toefl_reading')->nullable();
            $table->integer('toefl_writing')->nullable();
            $table->integer('toefl_listening')->nullable();
            $table->integer('toefl_speaking')->nullable();
            $table->integer('toefl_overall')->nullable();

            $table->boolean('duolingo_required')->default(false);
            $table->integer('duolingo_total')->nullable();

            $table->boolean('pte_required')->default(false);
            $table->integer('pte_reading')->nullable();
            $table->integer('pte_writing')->nullable();
            $table->integer('pte_listening')->nullable();
            $table->integer('pte_speaking')->nullable();
            $table->integer('pte_overall')->nullable();

            // ===============================
            // Program Meta
            // ===============================
            $table->unsignedBigInteger('program_tag_id')->nullable();
            $table->string('program_tag_name')->nullable();
            $table->string('no_exam_status')->nullable();
            $table->string('application_fee')->nullable();
            $table->string('application_short_desc')->nullable();
            $table->string('average_graduate_program')->nullable();
            $table->string('average_graduate_program_short_desc')->nullable();
            $table->string('average_undergraduate_program')->nullable();
            $table->string('average_undergraduate_program_short_desc')->nullable();
            $table->string('cost_of_living')->nullable();
            $table->string('cost_of_living_short_desc')->nullable();
            $table->string('average_gross_tuition')->nullable();
            $table->string('average_gross_tuition_short_desc')->nullable();
            $table->string('campus_city')->nullable();
            $table->string('duration')->nullable();
            $table->string('success_chance')->nullable();
            $table->text('program_summary')->nullable();
            $table->json('intake_months')->nullable();
            $table->json('images')->nullable();

            // ===============================
            // Student Profile
            // ===============================
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('destination')->nullable();
            $table->string('study_level')->nullable();
            $table->string('subject')->nullable();
            $table->string('student_profile_nationality')->nullable();
            $table->string('passport')->nullable();
            $table->string('elp')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('country_of_residence')->nullable();
            $table->string('specialization')->nullable();
            $table->text('sop')->nullable();
            $table->text('achievements')->nullable();
            $table->string('resume')->nullable();
            $table->string('passport_copy')->nullable();
            $table->string('transcripts')->nullable();
            $table->string('english_test')->nullable();
            $table->string('photo')->nullable();

            // ===============================
            // Arrays (JSON)
            // ===============================
            $table->json('academic_qualifications')->nullable();
            $table->json('test_scores')->nullable();
            $table->json('work_experiences')->nullable();
            $table->json('references')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
