<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntakeMonth extends Model
{
    use HasFactory;

      protected $fillable = [
        'intake_id',
        'month',
        'open_date',
        'submission_deadline',
    ];
    
    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }
    // public function universityPrograms()
    // {
    //     return $this->hasMany(UniversityProgram::class);
    // }
    public function universityPrograms()
    {
        return $this->hasMany(UniversityProgram::class,'id');
    }
}
