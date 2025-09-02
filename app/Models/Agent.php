<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'agent';

    protected $fillable = [
        'prefix',
        'first_name',
        'last_name',
        'company_name',
        'job_title',
        'country_dialing_code',
        'phone_number',
        'email',
        'finance_email',
        'password',
        'street_address',
        'street_address_line_2',
        'city',
        'state_province',
        'postal_zip_code',
        'country',
        'director_title',
        'director_first_name',
        'director_last_name',
        'director_job_title',
        'director_phone_code',
        'director_phone_number',
        'director_email',
        'students_per_year',
        'destinations',
        'litigation_status',
        'australia_recruitment',
        'other_institutions',
        'college_name',
        'creative_course',
        'university_preparation',
        'adult_english_language',
        'junior_english_language',
        'direct_entry_to_university',
        'company_established_year',
        'branch_offices',
        'counsellors_employed',
        'icef_registered',
        'source_of_information',
        'reason_to_work_with_oxford',
        'first_referee_title',
        'first_referee_first_name',
        'first_referee_last_name',
        'first_referee_company_name',
        'first_referee_email',
        'first_referee_phone_country_code',
        'first_referee_phone_number',
        'first_referee_website',
        'status',
        'is_approved',
        'token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'icef_registered' => 'boolean',
    ];

    // 🔹 Custom helper methods
    public function isApproved()
    {
        return (bool) $this->is_approved;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
