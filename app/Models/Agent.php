<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        "prefix","first_name","last_name","company_name","job_title",
        "country_dialing_code","phone_number","email","finance_email","password",
        "street_address","street_address_line2","city","state","postal_code","country",
        "destinations","litigation_status","litigation_details",
        "australia_recruitment","australia_recruitment_details",
        "other_institutions","trading_name","website",
        "director_prefix","director_first_name","director_last_name","director_job_title",
        "director_country_dialing_code","director_phone_number","director_email",
        "students_per_year","college","creative_course","university_prep",
        "adult_english","junior_english","direct_university",
        "established_year","branch_offices","counsellors","icef_registered","ias_id_number",
        "hear_about","why_work_with_us",
        "ref1_prefix","ref1_first_name","ref1_last_name","ref1_company",
        "ref1_email","ref1_country_dialing_code","ref1_phone_number","ref1_website"
    ];
}
