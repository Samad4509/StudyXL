<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldOFSubject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name', 'study_field_name','field_of_study_id'];

    public function fieldOfStudy()
    {
         return $this->hasMany(FieldOFSubject::class, 'field_of_study_id');
    }
}
