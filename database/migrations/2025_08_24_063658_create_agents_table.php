<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up(): void
{
    Schema::create('agents', function (Blueprint $table) {
        $table->id();
        $table->string('prefix')->nullable();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('company_name');
        $table->string('job_title');
        $table->string('country_dialing_code', 10)->nullable(); // ছোট রাখা হলো
        $table->string('phone_number');
        $table->string('email')->unique();
        $table->string('finance_email');
        $table->string('password');
        $table->string('street_address');
        $table->string('street_address_line2')->nullable();
        $table->string('city');
        $table->string('state')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('country');
        $table->json('destinations')->nullable(); // একাধিক দেশ array আকারে সেভ হবে
        $table->enum('litigation_status', ['yes','no'])->nullable();
        $table->text('litigation_details')->nullable();
        $table->enum('australia_recruitment', ['yes','no'])->nullable();
        $table->text('australia_recruitment_details')->nullable();
        $table->text('other_institutions')->nullable();

        // Company details
        $table->string('trading_name')->nullable();
        $table->string('website')->nullable();

        // Director details
        $table->string('director_prefix')->nullable();
        $table->string('director_first_name')->nullable();
        $table->string('director_last_name')->nullable();
        $table->string('director_job_title')->nullable();
        $table->string('director_country_dialing_code',10)->nullable();
        $table->string('director_phone_number')->nullable();
        $table->string('director_email')->nullable();

        // Company overview
        $table->string('students_per_year')->nullable();

        // Courses
        $table->string('college')->nullable();
        $table->string('creative_course')->nullable();
        $table->string('university_prep')->nullable();
        $table->string('adult_english')->nullable();
        $table->string('junior_english')->nullable();
        $table->string('direct_university')->nullable();

        // Operations
        $table->string('established_year')->nullable();
        $table->string('branch_offices')->nullable();
        $table->string('counsellors')->nullable();
        $table->string('icef_registered')->nullable();
        $table->string('ias_id_number')->nullable();
        $table->string('hear_about')->nullable();
        $table->text('why_work_with_us')->nullable();

        // References
        $table->string('ref1_prefix')->nullable();
        $table->string('ref1_first_name')->nullable();
        $table->string('ref1_last_name')->nullable();
        $table->string('ref1_company')->nullable();
        $table->string('ref1_email')->nullable();
        $table->string('ref1_country_dialing_code',10)->nullable();
        $table->string('ref1_phone_number')->nullable();
        $table->string('ref1_website')->nullable();

        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
