<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable =['destinations_name'];

    public function universities()
    {
        return $this->hasMany(University::class);
    }
}
