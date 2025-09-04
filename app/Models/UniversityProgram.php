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
        'program_intakes',
        'open_date',
        'submission_deadline',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
