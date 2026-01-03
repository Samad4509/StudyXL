<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = [
        'student_name',
        'student_id',
        'agent_name',
        'agent_id',
        'program_name',
        'university_name',
        'intake',
        'status',
    ];
}
