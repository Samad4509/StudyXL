<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldOfStudy extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    
    public function subjects()
    {
        return $this->hasMany(FieldOFSubject::class, 'field_of_study_id');
    }

}
