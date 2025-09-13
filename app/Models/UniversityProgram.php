<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityProgram extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'university_id',
        'program_name',
        'program_description',
        'program_level',
        'program_intakes',
        'open_date',
        'submission_deadline',
        'study_permit_or_visa',
        'nationality',
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
        'no_exam_status',
    ];

    protected $casts = [
        'ielts_required' => 'boolean',
        'toefl_required' => 'boolean',
        'duolingo_required' => 'boolean',
        'pte_required' => 'boolean',
        'open_date' => 'date',
        'submission_deadline' => 'datetime',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
