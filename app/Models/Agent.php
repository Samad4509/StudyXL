<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Permission;

class Agent extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'agent';

    protected $fillable = [
        "id","prefix","first_name","last_name","company_name","job_title",
        "country_dialing_code","phone_number","email","finance_email","password",
        "street_address","street_address_line2","city","state","postal_code","country",
        "director_prefix","director_first_name","director_last_name","director_job_title",
        "director_dialing_code","director_phone_number","director_email",
        "trading_name","website","students_per_year","destinations","other_destination",
        "litigation","litigation_details","australia_recruitment","australia_recruitment_details",
        "institutions","college","creative_course","university_preparation","adult_english",
        "junior_english","direct_entry","year_established","branch_offices","counsellors",
        "icef_id","hear_about","why_oxford","referee_prefix","referee_first_name",
        "referee_last_name","referee_company","referee_email","referee_dialing_code",
        "referee_phone","referee_website","created_at","updated_at","is_approved","status"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'icef_registered' => 'boolean',
    ];

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        // 🔹 Auto-generate agent ID
        static::creating(function ($agent) {
            if (!$agent->id) {
                $lastAgent = self::orderBy('id', 'desc')->first();
                $nextId = $lastAgent ? $lastAgent->id + 1 : 100000;
                if ($nextId > 999999) {
                    throw new \Exception("Maximum agents reached (6-digit limit).");
                }
                $agent->id = $nextId;
            }
        });

        // 🔹 Create default permissions for the agent after creation
        static::created(function ($agent) {
            $defaultPermissions = [
                'application.create',
                'application.view',
                'task.update',
                'task.assign',
            ];

            foreach ($defaultPermissions as $perm) {
                Permission::firstOrCreate([
                    'name' => $perm,
                    'guard_name' => 'agent', // Agent guard
                    'agent_id' => $agent->id  // dynamically link to this agent
                ]);
            }
        });
    }

    // 🔹 Custom helper methods
    public function isApproved()
    {
        return (bool) $this->is_approved;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    // 🔹 Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'agent_id');
    }

    public function employees()
    {
        return $this->hasMany(AgentEmployee::class, 'agent_id', 'id');
    }
}
