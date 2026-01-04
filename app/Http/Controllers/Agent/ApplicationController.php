<?php

namespace App\Http\Controllers\Agent;

use App\Models\Admin;
use App\Models\Application;
use App\Models\AgentStudent;
use Illuminate\Http\Request;
use App\Models\UniversityProgram;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AgentApplicationConfirmed;

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
            'program_id'          => $program->id,
            'program_name'    => $program->program_name,
            'university_name' => $program->university_name,
            'intake'          => $program->intake_name,
        ];

        // Return JSON
        return response()->json($data);
    }
    public function myApplications(Request $request)
    {
        $agent = Auth::guard('token')->user();

        $validated = $request->validate([
            'student_name'    => 'required|string|max:255',
            'student_id'      => 'required|integer',
            'agent_name'      => 'required|string|max:255',
            'agent_id'        => 'required|string|max:50',
            'program_id'      => 'required|string|max:50',
            'program_name'    => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'intake'          => 'required|string|max:100',
        ]);

        // Max 5 applications check
        $totalApplications = Application::where('student_id', $validated['student_id'])->count();
        if ($totalApplications >= 5) {
            return response()->json([
                'success' => false,
                'message' => 'A student can apply to a maximum of 5 programs only.'
            ], 400);
        }

        // Prevent duplicate program
        $alreadyApplied = Application::where('student_id', $validated['student_id'])
            ->where('program_id', $validated['program_id'])
            ->exists();

        if ($alreadyApplied) {
            return response()->json([
                'success' => false,
                'message' => 'This student has already applied for this program.'
            ], 400);
        }

        // Create application
        $validated['status'] = 'Submitted';
        $application = Application::create($validated);

        // Notify admins
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $admin->notify(new AgentApplicationConfirmed($application));
        }

        return response()->json([
            'success' => true,
            'message' => 'Application created successfully and Admin notified.',
            'data' => $application
        ], 201);
    }



    public function edit($id)
    {
        $application = Application::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $application
        ]);
    }

    // UPDATE application
    public function update(Request $request, $id)
    {
        $application = Application::findOrFail($id);

        $validated = $request->validate([
            'student_name'    => 'sometimes|string|max:255',
            'student_id'      => 'sometimes|integer',
            'agent_name'      => 'sometimes|string|max:255',
            'agent_id'        => 'sometimes|string|max:50',
            'program_name'    => 'sometimes|string|max:255',
            'university_name' => 'sometimes|string|max:255',
            'intake'          => 'sometimes|string|max:100',
            'status'          => 'sometimes|in:Submitted,Pending,Accepted,Rejected'
        ]);

        $application->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully',
            'data' => $application
        ]);
    }

    // DELETE application
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return response()->json([
            'success' => true,
            'message' => 'Application deleted successfully'
        ]);
    }

        public function getMyApplications()
    {
        // return "OK";
        // Step 1: Get logged-in agent
        return $agent = Auth::guard('token')->user(); // Token guard ব্যবহার করে

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not authenticated.'
            ], 401);
        }

        // Step 2: Get all applications submitted by this agent
        $applications = Application::where('agent_id', $agent->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Step 3: Check if any application exists
        if ($applications->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No applications found for this agent.'
            ], 404);
        }

        // Step 4: Return applications
        return response()->json([
            'success' => true,
            'data' => $applications
        ], 200);
    }

}




