<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','name','email','destination','study_level','subject','nationality',
        'passport','elp','dob','address','phone','gender','passport_expiry',
        'country_of_residence','program','intake','specialization',
        'academic_qualifications','test_scores','work_experiences','references',
        'sop','achievements','resume','passport_copy','transcripts','english_test','photo',
    ];

    protected $casts = [
        'academic_qualifications' => 'array',
        'test_scores' => 'array',
        'work_experiences' => 'array',
        'references' => 'array',
        'dob' => 'date:Y-m-d',
        'passport_expiry' => 'date:Y-m-d',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
