<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_name',
        'program_id',
        'program_name',
        'university_name',
        'intake',
        'status'
    ];
}
