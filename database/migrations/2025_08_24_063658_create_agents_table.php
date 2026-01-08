<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up()
    {
         Schema::create('agents', function (Blueprint $table) {
            
            $table->unsignedInteger('id')->primary();
            $table->string('prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('country_dialing_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('finance_email')->nullable();
            $table->string('password')->nullable();
            $table->string('street_address')->nullable();
            $table->string('street_address_line2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();

            $table->string('director_prefix')->nullable();
            $table->string('director_first_name')->nullable();
            $table->string('director_last_name')->nullable();
            $table->string('director_job_title')->nullable();
            $table->string('director_dialing_code')->nullable();
            $table->string('director_phone_number')->nullable();
            $table->string('director_email')->nullable();

            $table->string('trading_name')->nullable();
            $table->string('website')->nullable();
            $table->text('students_per_year')->nullable();
            $table->json('destinations')->nullable();
            $table->string('other_destination')->nullable();
            $table->string('litigation')->nullable();
            $table->text('litigation_details')->nullable();
            $table->string('australia_recruitment')->nullable();
            $table->text('australia_recruitment_details')->nullable();
            $table->string('institutions')->nullable();
            $table->string('college')->nullable(); 
            $table->string('creative_course')->nullable();
            $table->text('university_preparation');
            $table->text('adult_english');
            $table->text('junior_english');
            $table->text('direct_entry');
            $table->text('year_established');
            $table->text('branch_offices');
            $table->text('counsellors');
            $table->string('icef_id');
            $table->string('hear_about');
            $table->text('why_oxford')->nullable();

            $table->string('referee_prefix')->nullable();
            $table->string('referee_first_name')->nullable();
            $table->string('referee_last_name')->nullable();
            $table->string('referee_company')->nullable();
            $table->string('referee_email')->nullable();
            $table->string('referee_dialing_code')->nullable();
            $table->string('referee_phone')->nullable();
            $table->string('referee_website')->nullable();

            $table->text('is_approved')->default(false);
            // $table->string('status')->default('inactive');
            $table->enum('status', ['active', 'inactive'])->default('inactive'); 
            $table->string('token')->nullable(); 
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
