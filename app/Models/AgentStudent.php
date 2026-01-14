<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentStudent extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id','name','email','destination','study_level','subject','nationality',
        'passport','elp','dob','address','phone','gender','passport_expiry',
        'country_of_residence','program','intake','specialization',
        'academic_qualifications','test_scores','work_experiences','references',
        'sop','achievements','resume','passport_copy','transcripts','english_test','photo','agent_id','company_name','id'
    ];

    protected $casts = [
        'academic_qualifications' => 'array',
        'test_scores' => 'array',
        'work_experiences' => 'array',
        'references' => 'array',
        'dob' => 'date:Y-m-d',
        'passport_expiry' => 'date:Y-m-d',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'student_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($profile) {
            if (!$profile->id) {
                // Locking is optional for small apps
                $lastProfile = self::orderBy('id', 'desc')->first();
                $nextId = $lastProfile? $lastProfile->id + 1 : 1000;
                if ($nextId > 999999) {
                    throw new \Exception("Maximum agents reached (4-digit limit).");
                }
                $profile->id = $nextId;
            }
        });
    }

}
