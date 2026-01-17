<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

     protected $fillable = [
        'agent_name', 'agent_id', 'student_name', 'student_id',
        'university', 'program', 'tuition_fee', 'paid_amount',
        'balance_due', 'status', 'comm_percent', 'comm_earned',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
