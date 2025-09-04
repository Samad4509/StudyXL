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
        'full_name',
        'dob',
        'gender',
        'phone',
        'email',
        'address',

        // Passport / Identity
        'passport_number',
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
