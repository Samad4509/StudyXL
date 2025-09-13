<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;
    protected $fillable = [
        'university_name',
        'address',
        'location',
        'phone_number',
        'images',
        'founded',
        'school_id',
        'institution_type',
        'dli_number',
        'top_disciplines',
        
        'application_fee',
        'application_short_desc',
        'average_graduate_program',
        'average_graduate_program_short_desc',
        'average_undergraduate_program',
        'average_undergraduate_program_short_desc',
        'cost_of_living',
        'cost_of_living_short_desc',
        'average_gross_tuition',
        'average_gross_tuition_short_desc',
    ];

    protected $casts = [
        'images' => 'array',
        'top_disciplines' => 'array',
    ];
}
