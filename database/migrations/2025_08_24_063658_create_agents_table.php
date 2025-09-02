<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name');
            $table->string('job_title');
            $table->string('country_dialing_code');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('finance_email')->unique();
            $table->string('password');
            $table->string('trading_name')->nullable();
            $table->string('website')->nullable();
            $table->string('street_address');
            $table->string('street_address_line_2')->nullable();
            $table->string('city');
            $table->string('state_province');
            $table->string('postal_zip_code');
            $table->string('country');
            $table->string('director_title');
            $table->string('director_first_name');
            $table->string('director_last_name');
            $table->string('director_job_title');
            $table->string('director_phone_code');
            $table->string('director_phone_number');
            $table->string('director_email');
            $table->string('students_per_year');
            $table->json('destinations');
            $table->string('litigation_status');
            $table->string('australia_recruitment');
            $table->string('other_institutions');
            $table->string('college_name');
            $table->string('creative_course');
            $table->string('university_preparation');
            $table->string('adult_english_language');
            $table->string('junior_english_language');
            $table->string('direct_entry_to_university');
            $table->integer('company_established_year');
            $table->string('branch_offices');
            $table->integer('counsellors_employed');
            $table->boolean('icef_registered');
            $table->string('source_of_information');
            $table->string('reason_to_work_with_oxford');
            $table->string('first_referee_title');
            $table->string('first_referee_first_name');
            $table->string('first_referee_last_name');
            $table->string('first_referee_company_name');
            $table->string('first_referee_email');
            $table->string('first_referee_phone_country_code');
            $table->string('first_referee_phone_number');
            $table->string('first_referee_website');
            $table->string('token')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
