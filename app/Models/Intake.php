<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
    ];
    
    public function months()
    {
        return $this->hasMany(IntakeMonth::class);
    }

     public function universityPrograms()
    {
        return $this->hasMany(UniversityProgram::class);
    }


}
