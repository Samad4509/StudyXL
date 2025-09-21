<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

  protected $fillable = [
        // User linking
        'user_id',

        // Personal Information
        'name',
        'dob',
        'gender',
        'phone',
        'email',
        'address',
        'destination',
        'elp',
        'subject',
        'passport',
        'dob',
        'address',
        'phone',
        'gender',
        'program',
        'intake',
        'specialization',
        'qualification',
        'institution',
        'year',
        'cgpa',
        'test_name',
        'test_score',
        'test_year',
        'organization',
        'position',
        'start_date',
        'end_date',
        'description',
        'reference_name',
        'reference_email',
        'reference_relationship',
        'reference_phone',
        'sop',
        'achievements',

        // Passport / Identity
    
        'passport_expiry',
        'nationality',
        'country_of_residence',

        // Program Details
        'desired_program',
        'preferred_intake',
        'study_level',
        'specialization',

        // Academic Qualification
        'qualification',
        'institution',
        'year',
        'cgpa',

        // Statement of Purpose
        'sop',

        // Extracurricular / Achievements
        'extracurricular',

        // Attachments
        'resume',
        'passport_copy',
        'transcripts',
        'english_test',
        'photo',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
