<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class AgentEmployee extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable, HasRoles;

    // protected $guard = 'agent';
    protected $guard_name = 'agent';

    protected $fillable = [
        'agent_id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
     public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'id');
    }
}
