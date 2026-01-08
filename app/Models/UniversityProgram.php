<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityProgram extends Model
{
    use HasFactory;

    
    // protected $fillable = [
    //     'university_name',
    //     'address',
    //     'location',
    //     'phone_number',
    //     'images',
    //     'university_id',
    //     'program_level_id',
    //     'program_name',
    //     'field_of_study_name',    
    //     'field_of_study_id',
    //     'intake_name',
    //     'intake_id',
    //     'intake_months',
    //     'program_tag_name',
    //     'program_tag_id',
    //     'program_description',
    //     'program_level',
    //     'open_date',
    //     'submission_deadline',
    //     'study_permit_or_visa',
    //     'nationality',
    //     'education_country',
    //     'last_level_of_study',
    //     'grading_scheme',
    //     'ielts_required',
    //     'ielts_reading',
    //     'ielts_writing',
    //     'ielts_listening',
    //     'ielts_speaking',
    //     'ielts_overall',
    //     'toefl_required',
    //     'toefl_reading',
    //     'toefl_writing',
    //     'toefl_listening',
    //     'toefl_speaking',
    //     'toefl_overall',
    //     'duolingo_required',
    //     'duolingo_total',
    //     'pte_required',
    //     'pte_reading',
    //     'pte_writing',
    //     'pte_listening',
    //     'pte_speaking',
    //     'pte_overall',
    //     'no_exam_status',
    // ];

    // protected $casts = [
    //     'ielts_required' => 'boolean',
    //     'toefl_required' => 'boolean',
    //     'duolingo_required' => 'boolean',
    //     'pte_required' => 'boolean',
    //     'open_date' => 'date',
    //     'submission_deadline' => 'datetime',
    //     'intake_months' => 'array',
    // ];

    protected $fillable = [
        // University Info
        'university_name',
        'address',
        'location',
        'phone_number',
        'images',
        'university_id',

        // Program Info
        'program_level_id',
        'program_name',
        'program_description',
        'program_level',
        'field_of_study_name',    
        'field_of_study_id',
        'intake_name',
        'intake_id',
        'intake_months',
        'program_tag_name',
        'program_tag_id',
        'open_date',
        'submission_deadline',

        // Additional fields
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

        // Student Requirements
        'study_permit_or_visa',
        'nationality',
        'education_country',
        'last_level_of_study',
        'grading_scheme',

        // English Exams
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

        'no_exam_status',
    ];

    protected $casts = [
        'ielts_required' => 'boolean',
        'toefl_required' => 'boolean',
        'duolingo_required' => 'boolean',
        'pte_required' => 'boolean',
        'open_date' => 'date',
        'submission_deadline' => 'datetime',
        'intake_months' => 'array',
        'images' => 'array',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function programLevel()
    {
        return $this->belongsTo(ProgramLevel::class);
    }

    public function fieldOfStudy()
    {
        return $this->belongsTo(FieldOfStudy::class);
    }

    public function intakes()
    {
        return $this->belongsTo(Intake::class);
    }

     public function intake_months()
    {
        return $this->hasMany(
            IntakeMonth::class,   // related model
            'intake_id',          // foreign key in intake_months table
            'intake_id'           // local key in university_programs table
        );
    }
   
}
