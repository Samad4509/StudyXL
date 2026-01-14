<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   protected $fillable = [
        'title',
        'status',
        'due_date',
        'student_id',
        'student_name',
        'agent_id',
        'agent_name',
        'university_id',
        'university_name',
        'program_id',
        'program_name',
        'documents',
    ];

    protected $casts = [
        'documents' => 'array',
    ];

     public function student()
    {
        return $this->belongsTo(AgentStudent::class, 'student_id');
    }

    
}
