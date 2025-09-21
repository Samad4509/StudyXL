<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Agent extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
    "id","prefix","first_name","last_name","company_name","job_title",
    "country_dialing_code","phone_number","email","finance_email","password",
    "street_address","street_address_line2","city","state","postal_code","country",
    "director_prefix","director_first_name","director_last_name","director_job_title",
    "director_dialing_code","director_phone_number","director_email",
    "trading_name","website","students_per_year","destinations","other_destination",
    "litigation","litigation_details","australia_recruitment","australia_recruitment_details",
    "institutions","college","creative_course","university_preparation","adult_english",
    "junior_english","direct_entry","year_established","branch_offices","counsellors",
    "icef_id","hear_about","why_oxford","referee_prefix","referee_first_name",
    "referee_last_name","referee_company","referee_email","referee_dialing_code",
    "referee_phone","referee_website","created_at","updated_at","is_approved","status"
    ];

    protected $hidden = [
        'password',
    ];
}
