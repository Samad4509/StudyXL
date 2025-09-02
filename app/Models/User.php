<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'destination',
        'study_level',
        'subject',
        'nationality',
        'elp',
        'passport',
    ];

    // Hide sensitive fields in JSON responses
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast fields
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
