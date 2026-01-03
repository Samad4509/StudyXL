<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentStudent;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function StudentInfo($student_id)
    {
       return  $student = AgentStudent::find($student_id);
    }
}
