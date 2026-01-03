<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentStudent;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function createApplications($student_id, $program_id)
    {
        $student = AgentStudent::findOrFail($student_id);
        $program = UniversityProgram::findOrFail($program_id);

        return [
            'student_name'    => $student->name,
            'program_name'    => $program->program_name,
            'university_name' => $program->university_name,
            'intake'          => $program->intake_name,
        ];
    }

    public function StudentInfo($student_id){

       return  $student = AgentStudent::findOrFail($student_id);
    }

}
