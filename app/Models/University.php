<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'address',
        'location',
        'phone_number',
        'images',
        'founded',
        'school_id',
        'dli_number',
        'institution_type',
        'amount',
        'amount_desc',
        'one_year',
        'one_year_desc',
        'course_years',
        'course_years_desc',
        'amount_years',
        'amount_years_desc',
        'first_year_amount',
        'first_year_desc',
        'application_processing_time',
        'top_disciplines', 
    ];



    public function programs()
    {
        return $this->hasMany(UniversityProgram::class);
    }

    protected $casts = [
        'images' => 'array',
        'top_disciplines' => 'array',
    ];
}
