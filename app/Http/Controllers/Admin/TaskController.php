<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Notifications\TaskUpdated;
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

        public function allTasks()
    {
        $tasks = Task::all();

        return response()->json([
            'status' => true,
            'total' => $tasks->count(),
            'tasks' => $tasks
        ], 200);
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
        $admin = Auth::guard('admin_token')->user(); // Get authenticated admin

        // 1️⃣ Validation
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subject' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:Pending,In Progress,Completed',
            'due_date' => 'required|date',

            'student_id' => 'required|integer',
            'student_name' => 'required|string|max:255',

            'agent_id' => 'required|integer',
            'agent_name' => 'required|string|max:255',

            'university_id' => 'required|integer',
            'university_name' => 'required|string|max:255',

            'program_id' => 'required|integer',
            'program_name' => 'required|string|max:255',

            'documents' => 'nullable',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // 2️⃣ Handle multi-file upload
        $documentPaths = [];
        if ($request->hasFile('documents')) {
            $files = $request->file('documents');
            if (!is_array($files)) $files = [$files];

            foreach ($files as $file) {
                $safeName = preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $fileName = 'doc_' . time() . '_' . uniqid() . '_' . $safeName;
                $file->move(public_path('uploads/documents'), $fileName);
                $documentPaths[] = 'uploads/documents/' . $fileName;
            }
        }

        $data['documents'] = $documentPaths;

        // 3️⃣ Save admin ID
        if ($admin) {
            $data['created_by'] = $admin->id;
        }

        // 4️⃣ Create Task
        // $task = Task::create($data);
         // Create Task
        $task = Task::create($data);

        // Send Notification to Agent
        $agent = Agent::find($task->agent_id); // agent must exist in users table
        if ($agent) {
            $agent->notify(new \App\Notifications\TaskAssigned($task));
        }



        return response()->json([
            'status' => 'success',
            'message' => 'Task created successfully',
            'task' => $task,
            'documents' => $documentPaths
        ], 201);
    }

    public function edit(Task $task)
    {
      
        $admin = Auth::guard('admin_token')->user(); 
       
        if (!$admin) {
            return response()->json(['status'=>'error','message'=>'Unauthorized'], 401);
        }

        return response()->json([
            'status' => 'success',
            'task' => $task
        ], 200);
    }



   public function update(Request $request, Task $task)
    {
    
        $admin = Auth::guard('admin_token')->user();

        // Validation rules
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'subject' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:500',
            'status' => 'sometimes|required|in:Pending,In Progress,Completed',
            'due_date' => 'sometimes|required|date',
            'student_id' => 'sometimes|required|integer',
            'student_name' => 'sometimes|required|string|max:255',
            'agent_id' => 'sometimes|required|integer',
            'agent_name' => 'sometimes|required|string|max:255',
            'university_id' => 'sometimes|required|integer',
            'university_name' => 'sometimes|required|string|max:255',
            'program_id' => 'sometimes|required|integer',
            'program_name' => 'sometimes|required|string|max:255',
            'documents' => 'nullable',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // Handle multi-file upload - append new files to existing ones
        $documentPaths = $task->documents ?? [];
        if ($request->hasFile('documents')) {
            $files = $request->file('documents');
            if (!is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $file) {
                $safeName = preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $fileName = 'doc_' . time() . '_' . uniqid() . '_' . $safeName;
                $file->move(public_path('uploads/documents'), $fileName);
                $documentPaths[] = 'uploads/documents/' . $fileName;
            }
        }

        $data['documents'] = $documentPaths;

        // Optional: Track admin who updated the task
        if ($admin) {
            $data['updated_by'] = $admin->id;
        }

        // Update task
        $task->update($data);

        // Refresh to get latest data from DB
        $task->refresh();

        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully',
            'task' => $task,
            'documents' => $documentPaths,
        ], 200);
    }

        public function destroy(Task $task)
    {
        // Get the authenticated admin (optional for logging)
        $admin = Auth::guard('admin_token')->user();

        // Optional: check if admin is authorized
        if (!$admin) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // Delete uploaded files safely
        if ($task->documents) {
            foreach ($task->documents as $filePath) {
                $fullPath = public_path($filePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath); // "@" suppresses errors if file can't be deleted
                }
            }
        }

        // Delete the task from the database
        $task->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Task deleted successfully'
        ], 200);
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

        public function agentTasks(Request $request)
    {
        // 1️⃣ Get authenticated agent
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // 2️⃣ Fetch tasks assigned to this agent
        $tasks = Task::where('agent_id', $agent->id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return response()->json([
            'status' => 'success',
            'agent_id' => $agent->id,
            'total_tasks' => $tasks->count(),
            'tasks' => $tasks
        ], 200);
    }

    public function agentUpdateTask(Request $request, Task $task)
    {
        // 1️⃣ Get authenticated agent
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 401);
        }

        // 2️⃣ Ensure agent owns this task
        if ((int) $task->agent_id !== (int) $agent->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'You are not allowed to update this task'
            ], 403);
        }

        // 3️⃣ Validation
        $validator = Validator::make($request->all(), [
            'status' => 'sometimes|required|in:Pending,In Progress,Completed',
            'title' => 'nullable|string|max:500',
            'subject' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:500',
            'documents' => 'nullable|array',
            'documents.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();

        // 4️⃣ Handle document uploads
        $documentPaths = $task->documents ?? [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $safeName = preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $fileName = 'doc_' . time() . '_' . uniqid() . '_' . $safeName;

                $file->move(public_path('uploads/documents'), $fileName);
                $documentPaths[] = 'uploads/documents/' . $fileName;
            }
        }

        $data['documents'] = $documentPaths;
        $data['updated_by_agent'] = $agent->id;

        // 5️⃣ Update task
        $task->update($data);
        $task->refresh();

        // 6️⃣ Notify Admin
        $admin = Admin::find(1); // fixed admin ID
        if ($admin) {
            $admin->notify(new TaskUpdated($task, $agent));
        }

        // 7️⃣ Success response
        return response()->json([
            'status' => 'success',
            'message' => 'Task updated successfully',
            'task' => $task,
            'documents' => $documentPaths
        ], 200);
    }


}
