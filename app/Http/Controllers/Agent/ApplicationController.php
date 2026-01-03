<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentStudent;
use App\Models\UniversityProgram;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function StudentInfo( $program_id)
    {
        
        $program = UniversityProgram::find($program_id);


        if (!$program) {
            return response()->json(['error' => 'Program not found'], 404);
        }

        // Combine all data into a single variable
        $data = [
            'program_name'    => $program->program_name,
            'university_name' => $program->university_name,
            'intake'          => $program->intake_name,
        ];

        // Return JSON
        return response()->json($data);
    }

        public function createApplications($student_id, $program_id)
    {
        $agent = Auth::guard('agent')->user();

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $student = AgentStudent::where('id', $student_id)
            ->where('agent_id', $agent->id)
            ->firstOrFail();

        $program = UniversityProgram::findOrFail($program_id);

        // (optional) applications table এ save
        $application = Application::create([
            'agent_id'        => $agent->id,
            'student_id'      => $student->id,
            'program_id'      => $program->id,
            'status'          => 'Submitted',
            'submitted_at'    => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'application_id' => 'APP-' . str_pad($application->id, 3, '0', STR_PAD_LEFT),
                'student_name'   => $student->name,
                'student_id'     => $student->id,
                'agent_name'     => $agent->company_name,
                'agent_id'       => $agent->id,
                'program_name'   => $program->program_name,
                'university_name'=> $program->university_name,
                'intake'         => $program->intake_name,
                'status'         => $application->status,
                'submitted'      => $application->created_at->format('Y-m-d')
            ]
        ]);
    }


}
