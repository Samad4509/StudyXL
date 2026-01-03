<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentStudent;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;
use App\Models\Application;
class ApplicationController extends Controller
{
    public function StudentInfo($student_id, $program_id)
    {
        // Student and Program
        $student = AgentStudent::find($student_id);
        $program = UniversityProgram::find($program_id);

        // Safety check
        if (!$student) {
            return response()->json(['error' => 'Student not found'], 404);
        }

        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }

        // Combine all data into a single variable
        $data = [
            'student_name'      => $student->name,
            'student_id'        => $student->id,
            'agent_name'        =>$student->company_name,
            'agent_id'          => $student->agent_id,
            'program_name'    => $program->program_name,
            'university_name' => $program->university_name,
            'intake'          => $program->intake_name,
        ];

        // Return JSON
        return response()->json($data);
    }

        public function myApplications(Request $request)
        {
            $validated = $request->validate([
                'student_name'    => 'required|string|max:255',
                'student_id'      => 'required|integer',
                'agent_name'      => 'required|string|max:255',
                'agent_id'        => 'required|string|max:50',
                'program_name'    => 'required|string|max:255',
                'university_name' => 'required|string|max:255',
                'intake'          => 'required|string|max:100',
            ]);

            $validated['status'] = 'Submitted';

            $application = Application::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Application created successfully',
                'data' => $application
            ], 201);
        }

}




