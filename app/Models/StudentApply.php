<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApply extends Model
{
    protected $fillable = [
        'student_id',
        'student_name',
        'program_id',
        'program_name',
        'university_name',
        'intake',
        'status',
    ];

    // Program এর সাথে রিলেশন
    public function program()
    {
        // এইটা বলে দিচ্ছে, StudentApply এর program_id ফিল্ড UniversityProgram এর id ফিল্ডকে রেফার করে
        return $this->belongsTo(UniversityProgram::class, 'program_id', 'id');
    }
}
