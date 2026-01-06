<?php

namespace App\Http\Controllers\Student;

use App\Models\Admin;

use App\Models\StudentApply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationNotification;

class StudentApplication extends Controller
{
    public function application(Request $request)
    {
        // ✅ Get logged-in student via sanctum token
        $student = Auth::guard('student_token')->user();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not authenticated or token invalid.'
            ], 401);
        }

        // ✅ Validate request
        $validated = $request->validate([
            'program_id'      => 'required|string|max:50',
            'program_name'    => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'intake'          => 'required|string|max:100',
        ]);

        // ✅ Max 5 applications check
        $totalApplications = StudentApply::where('student_id', $student->id)->count();
        if ($totalApplications >= 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can apply to a maximum of 5 programs only.'
            ], 400);
        }

        // ✅ Prevent duplicate program
        $alreadyApplied = StudentApply::where('student_id', $student->id)
            ->where('program_id', $validated['program_id'])
            ->exists();
        if ($alreadyApplied) {
            return response()->json([
                'success' => false,
                'message' => 'You have already applied for this program.'
            ], 400);
        }

        // ✅ Create application
        $application = StudentApply::create([
            'student_id'      => $student->id,
            'student_name'    => $student->name,
            'program_id'      => $validated['program_id'],
            'program_name'    => $validated['program_name'],
            'university_name' => $validated['university_name'],
            'intake'          => $validated['intake'],
            'status'          => 'Submitted',
        ]);

        // ✅ Notify all admins
        foreach (Admin::all() as $admin) {
            $admin->notify(new ApplicationNotification($application->id, 'student'));
        }

        return response()->json([
            'success' => true,
            'message' => 'Application submitted successfully.',
            'data'    => $application
        ], 201);
    }

    public function myApplications()
{
    // return "OK";
    $student = Auth::guard('student_token')->user();

    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not authenticated'
        ], 401);
    }

    $applications = StudentApply::where('student_id', $student->id)
        ->latest()
        ->get();

    return response()->json([
        'success' => true,
        'total' => $applications->count(),
        'data' => $applications
    ]);
}


    
}
