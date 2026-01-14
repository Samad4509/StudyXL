<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{


    public function index(Request $request)
    {
        $student_id = $request->query('student_id');

        if (!$student_id) {
            return response()->json([
                'status' => 'error',
                'message' => 'student_id is required'
            ], 400);
        }

        $tasks = Task::where('student_id', $student_id)->get();

        return response()->json([
            'status' => 'success',
            'student_id' => $student_id,
            'tasks' => $tasks
        ]);
    }
         public function agentByapplication($agent_id)
    {
        
        $admin = Auth::guard('admin_token')->user();

        
        $studentApplications = Application::where('agent_id', $agent_id)->get();

        
        return response()->json([
            'status' => 'success',
            'agent_id' => $agent_id,
            'applications' => $studentApplications
        ]);
    }

    public function store(Request $request)
    {
        // 1️⃣ Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'required|date',
            'student_id' => 'required|integer',
            'student_name' => 'required|string',
            'agent_id' => 'required|integer',
            'agent_name' => 'required|string',
            'university_id' => 'required|integer',
            'university_name' => 'required|string',
            'program_id' => 'required|integer',
            'program_name' => 'required|string',
            'documents' => 'nullable', // file array অথবা filename array
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // 2️⃣ Handle documents
        $documents = [];

        // যদি ফাইল আসে
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('uploads/documents', 'public');
                $documents[] = $path;
            }
        } 
        // যদি শুধু filenames/path আসে
        elseif ($request->input('documents')) {
            $documents = $request->input('documents');
            if (!is_array($documents)) {
                $documents = [$documents];
            }
        }

        $data['documents'] = $documents;

        // 3️⃣ Task তৈরি
        $task = Task::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }



        public function agentStudentApplication($student_id)
    {
        // student_id অনুযায়ী filter করা
        $applications = Application::where('student_id', $student_id)->get();

        // যদি কোনো application না থাকে
        if ($applications->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No applications found for this student'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'student_id' => $student_id,
            'applications' => $applications
        ]);
    }

    
    public function programApplications($program_id)
    {
        
        $applications = Application::where('program_id', $program_id)->get();

        if ($applications->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No applications found for this program'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'program_id' => $program_id,
            'applications' => $applications
        ]);
    }
}
