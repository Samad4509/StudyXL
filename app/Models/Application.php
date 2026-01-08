<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    // protected $fillable = [
    //     'student_name',
    //     'student_id',
    //     'agent_name',
    //     'agent_id',
    //     'program_id',
    //     'program_name',
    //     'university_name',
    //     'intake',
    //     'status',
    // ];

     protected $fillable = [
        'student_name',
        'student_id',
        'agent_name',
        'agent_id',
        'program_id',
        'program_name',
        'university_name',
        'intake',
        'status',
        'program_level_id',
        'program_description',
        'program_level',
        'program_open_date',
        'program_submission_deadline',
        'intake_name',
        'field_of_study_id',
        'field_of_study_name',
        'study_permit_or_visa',
        'program_nationality',
        'education_country',
        'last_level_of_study',
        'grading_scheme',
        'ielts_required',
        'ielts_reading',
        'ielts_writing',
        'ielts_listening',
        'ielts_speaking',
        'ielts_overall',
        'toefl_required',
        'toefl_reading',
        'toefl_writing',
        'toefl_listening',
        'toefl_speaking',
        'toefl_overall',
        'duolingo_required',
        'duolingo_total',
        'pte_required',
        'pte_reading',
        'pte_writing',
        'pte_listening',
        'pte_speaking',
        'pte_overall',
        'program_tag_id',
        'program_tag_name',
        'no_exam_status',
        'application_fee',
        'application_short_desc',
        'average_graduate_program',
        'average_graduate_program_short_desc',
        'average_undergraduate_program',
        'average_undergraduate_program_short_desc',
        'cost_of_living',
        'cost_of_living_short_desc',
        'average_gross_tuition',
        'average_gross_tuition_short_desc',
        'campus_city',
        'duration',
        'success_chance',
        'program_summary',
        'intake_months',
        'images',
        'company_name',
        'email',
        'destination',
        'study_level',
        'subject',
        'student_profile_nationality',
        'passport',
        'elp',
        'dob',
        'address',
        'phone',
        'gender',
        'passport_expiry',
        'country_of_residence',
        'specialization',
        'sop',
        'achievements',
        'resume',
        'passport_copy',
        'transcripts',
        'english_test',
        'photo',
        'academic_qualifications',
        'test_scores',
        'work_experiences',
        'references'
    ];

    protected $casts = [
        'intake_months' => 'array',
        'images' => 'array',
        'academic_qualifications' => 'array',
        'test_scores' => 'array',
        'work_experiences' => 'array',
        'references' => 'array',
        'ielts_required' => 'boolean',
        'toefl_required' => 'boolean',
        'duolingo_required' => 'boolean',
        'pte_required' => 'boolean',
    ];

     

     public function program()
    {
        return $this->belongsTo(UniversityProgram::class, 'program_id');
    }
}
