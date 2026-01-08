<?php

namespace App\Http\Controllers\Agent;

use App\Models\Admin;
use App\Models\Application;
use App\Models\AgentStudent;
use Illuminate\Http\Request;
use App\Models\UniversityProgram;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ApplicationNotification;
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
            'agent_name'        => $student->company_name,
            'agent_id'          => $student->agent_id,
            'program_id'          => $program->id,
            'program_name'    => $program->program_name,
            'university_name' => $program->university_name,
            'intake'          => $program->intake_name,
        ];

        // Return JSON
        return response()->json($data);
    }
    // public function myApplications(Request $request)
    // {
    //     $agent = Auth::guard('agent_token')->user();

    //     $validated = $request->validate([
    //         'student_name'    => 'required|string|max:255',
    //         'student_id'      => 'required|integer',
    //         'agent_name'      => 'required|string|max:255',
    //         'agent_id'        => 'required|string|max:50',
    //         'program_id'      => 'required|string|max:50',
    //         'program_name'    => 'required|string|max:255',
    //         'university_name' => 'required|string|max:255',
    //         'intake'          => 'required|string|max:100',
    //     ]);

    //     // Max 5 applications check
    //     $totalApplications = Application::where('student_id', $validated['student_id'])->count();
    //     if ($totalApplications >= 5) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'A student can apply to a maximum of 5 programs only.'
    //         ], 400);
    //     }

    //     // Prevent duplicate program
    //     $alreadyApplied = Application::where('student_id', $validated['student_id'])
    //         ->where('program_id', $validated['program_id'])
    //         ->exists();

    //     if ($alreadyApplied) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This student has already applied for this program.'
    //         ], 400);
    //     }

    //     // Create application
    //     $validated['status'] = 'Submitted';
    //     $application = Application::create($validated);

    //     // Notify admins
    //     $admins = Admin::all();
    //     foreach ($admins as $admin) {
    //         $admin->notify(new AgentApplicationConfirmed($application));
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Application created successfully and Admin notified.',
    //         'data' => $application
    //     ], 201);
    // }
    // public function myApplications(Request $request)
    // {

    //    $agent = Auth::guard('agent_token')->user();


    //     $validated = $request->validate([
    //         'student_name'    => 'required|string|max:255',
    //         'student_id'      => 'required|integer',
    //         'agent_name'      => 'required|string|max:255',
    //         'agent_id'        => 'required|string|max:50',
    //         'program_id'      => 'required|string|max:50',
    //         'program_name'    => 'required|string|max:255',
    //         'university_name' => 'required|string|max:255',
    //         'intake'          => 'required|string|max:100',
    //     ]);

    //     // Max 5 check
    //     $totalApplications = Application::where('student_id', $validated['student_id'])->count();
    //     if ($totalApplications >= 5) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'A student can apply to a maximum of 5 programs only.'
    //         ], 400);
    //     }

    //     // Duplicate check
    //     $alreadyApplied = Application::where('student_id', $validated['student_id'])
    //         ->where('program_id', $validated['program_id'])
    //         ->exists();

    //     if ($alreadyApplied) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'This student has already applied for this program.'
    //         ], 400);
    //     }

    //     // Create application
    //     $validated['status'] = 'Submitted';
    //    return $application = Application::create($validated);

    //     // 🔔 Notify Admin (IMPORTANT PART)
    //     foreach (Admin::all() as $admin) {
    //         $admin->notify(
    //             new ApplicationNotification($application->id, 'agent')
    //         );
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Application created successfully.',
    //         'data' => $application
    //     ], 201);
    // }

    public function myApplications(Request $request)
    {
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Agent not authenticated'
            ], 401);
        }

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

        // Max 5 applications per student
        $totalApplications = Application::where('student_id', $validated['student_id'])->count();
        if ($totalApplications >= 5) {
            return response()->json([
                'success' => false,
                'message' => 'A student can apply to a maximum of 5 programs only.'
            ], 400);
        }

        // Duplicate check
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
        $validated['status'] = 'Pending';
        $application = Application::create($validated);

        // 🔔 Notify ALL Admins (Agent application)
        foreach (Admin::all() as $admin) {
            $admin->notify(
                new ApplicationNotification($application->id, 'agent')
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Application created successfully.',
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
        $agent = Auth::guard('agent_token')->user(); // Token guard ব্যবহার করে

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

    // public function applicationDetail($id)
    // {
    //     $agent = Auth::guard('agent_token')->user();

    //     if (!$agent) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }


    //     $application = Application::where('id', $id)
    //         ->where('agent_id', $agent->id)
    //         ->with('program') 
    //         ->first();

    //     if (!$application) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Application not found'
    //         ], 404);
    //     }


    //     return response()->json([
    //         'success' => true,
    //         'data' => [
    //             'application' => $application 
    //         ]
    //     ]);
    // }

    // public function applicationDetail($id)
    // {
    //     $agent = Auth::guard('agent_token')->user();

    //     if (!$agent) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     // Fetch application with program
    //     $application = Application::where('id', $id)
    //         ->where('agent_id', $agent->id)
    //         ->with('program')
    //         ->first();

    //     if (!$application) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Application not found'
    //         ], 404);
    //     }

    //     // Fetch student profile (only personal data, no relation to program)
    //     $studentProfile = AgentStudent::where('agent_id', $agent->id)->first();

    //     // Decode JSON fields if you want (optional)
    //     if($studentProfile){
    //         $studentProfile->academic_qualifications = json_decode($studentProfile->academic_qualifications, true);
    //         $studentProfile->test_scores = json_decode($studentProfile->test_scores, true);
    //         $studentProfile->work_experiences = json_decode($studentProfile->work_experiences, true);
    //         $studentProfile->references = json_decode($studentProfile->references, true);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => [
    //             'application'     => $application,
    //             // 'program'         => $application->program,
    //             'student_profile' => $studentProfile
    //         ]
    //     ]);
    // }

    public function applicationDetail($id)
    {
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Fetch application with program
        $application = Application::where('id', $id)
            ->where('agent_id', $agent->id)
            ->with('program')
            ->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found'
            ], 404);
        }

        // Fetch student profile (only personal data, no relation to program)
        $studentProfile = AgentStudent::where('agent_id', $agent->id)->first();

        // Decode JSON fields if you want (optional)
        if ($studentProfile) {
            $studentProfile->academic_qualifications = json_decode($studentProfile->academic_qualifications, true);
            $studentProfile->test_scores = json_decode($studentProfile->test_scores, true);
            $studentProfile->work_experiences = json_decode($studentProfile->work_experiences, true);
            $studentProfile->references = json_decode($studentProfile->references, true);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'application'     => $application,
                // 'program'         => $application->program,
                'student_profile' => $studentProfile
            ]
        ]);
    }

    // public function applicationUpdate($id)
    // {
    //     $agent = Auth::guard('agent_token')->user();

    //     if (!$agent) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Unauthorized'
    //         ], 401);
    //     }

    //     // 1️⃣ Application
    //     $application = Application::where('id', $id)
    //         ->where('agent_id', $agent->id)
    //         ->first();

    //     if (!$application) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Application not found'
    //         ], 404);
    //     }

    //     // 2️⃣ Program
    //     $program = UniversityProgram::with('intake_months')
    //         ->where('id', $application->program_id)
    //         ->first();

    //     // 3️⃣ Student Profile
    //     $student = AgentStudent::where('agent_id', $agent->id)->first();

    //     // 4️⃣ Prepare MERGED DATA (match fillable)
    //     $data = [
    //         // Program info
    //         'program_level_id' => $program->program_level_id ?? null,
    //         'program_description' => $program->program_description ?? null,
    //         'program_level' => $program->program_level ?? null,
    //         'program_open_date' => $program->open_date ?? null,
    //         'program_submission_deadline' => $program->submission_deadline ?? null,
    //         'intake_name' => $program->intake_name ?? null,
    //         'field_of_study_id' => $program->field_of_study_id ?? null,
    //         'field_of_study_name' => $program->field_of_study_name ?? null,
    //         'study_permit_or_visa' => $program->study_permit_or_visa ?? null,
    //         'program_nationality' => $program->nationality ?? null,
    //         'education_country' => $program->education_country ?? null,
    //         'last_level_of_study' => $program->last_level_of_study ?? null,
    //         'grading_scheme' => $program->grading_scheme ?? null,

    //         'ielts_required' => $program->ielts_required ?? false,
    //         'ielts_reading' => $program->ielts_reading ?? null,
    //         'ielts_writing' => $program->ielts_writing ?? null,
    //         'ielts_listening' => $program->ielts_listening ?? null,
    //         'ielts_speaking' => $program->ielts_speaking ?? null,
    //         'ielts_overall' => $program->ielts_overall ?? null,

    //         'toefl_required' => $program->toefl_required ?? false,
    //         'toefl_overall' => $program->toefl_overall ?? null,

    //         'duolingo_required' => $program->duolingo_required ?? false,
    //         'duolingo_total' => $program->duolingo_total ?? null,

    //         'pte_required' => $program->pte_required ?? false,
    //         'pte_overall' => $program->pte_overall ?? null,

    //         'program_tag_id' => $program->program_tag_id ?? null,
    //         'program_tag_name' => $program->program_tag_name ?? null,

    //         'application_fee' => $program->application_fee ?? null,
    //         'campus_city' => $program->campus_city ?? null,
    //         'duration' => $program->duration ?? null,
    //         'success_chance' => $program->success_chance ?? null,
    //         'program_summary' => $program->program_summary ?? null,

    //         'intake_months' => $program->intake_months ?? [],
    //         'images' => $program->images ?? [],

    //         // Student Profile info
    //         'company_name' => $student->company_name ?? null,
    //         'email' => $student->email ?? null,
    //         'destination' => $student->destination ?? null,
    //         'study_level' => $student->study_level ?? null,
    //         'subject' => $student->subject ?? null,
    //         'student_profile_nationality' => $student->nationality ?? null,
    //         'passport' => $student->passport ?? null,
    //         'elp' => $student->elp ?? null,
    //         'dob' => $student->dob ?? null,
    //         'address' => $student->address ?? null,
    //         'phone' => $student->phone ?? null,
    //         'gender' => $student->gender ?? null,
    //         'passport_expiry' => $student->passport_expiry ?? null,
    //         'country_of_residence' => $student->country_of_residence ?? null,
    //         'specialization' => $student->specialization ?? null,

    //         'sop' => $student->sop ?? null,
    //         'achievements' => $student->achievements ?? null,
    //         'resume' => $student->resume ?? null,
    //         'passport_copy' => $student->passport_copy ?? null,
    //         'transcripts' => $student->transcripts ?? null,
    //         'english_test' => $student->english_test ?? null,
    //         'photo' => $student->photo ?? null,

    //         'academic_qualifications' => $student->academic_qualifications ?? [],
    //         'test_scores' => $student->test_scores ?? [],
    //         'work_experiences' => $student->work_experiences ?? [],
    //         'references' => $student->references ?? [],
    //     ];

    //     switch ($application->status) {
    //         case 'Pending':
    //             // Pending → Reviewed
    //             $data['status'] = 'Reviewed';
    //             break;

    //         case 'Rejected':
    //             // Rejected → can resubmit → Pending
    //             $data['status'] = 'Pending';
    //             break;

    //         case 'Reviewed':
    //         case 'Accepted':
    //             // Reviewed or Completed → cannot change status
    //             // just update other fields, status remains the same
    //             break;
    //     }
    //     // 5️⃣ UPDATE application
    //     $application->update($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Application merged & updated successfully',
    //         'data' => $application->fresh()
    //     ]);
    // }
    public function applicationUpdate($id)
    {
        // 1️⃣ Authenticate Agent
        $agent = Auth::guard('agent_token')->user();

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // 2️⃣ Find Application
        $application = Application::where('id', $id)
            ->where('agent_id', $agent->id)
            ->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found'
            ], 404);
        }

        // 3️⃣ Load Program
        $program = UniversityProgram::with('intake_months')
            ->where('id', $application->program_id)
            ->first();

        // 4️⃣ Load Student Profile
        $student = AgentStudent::where('agent_id', $agent->id)->first();

        // 5️⃣ Merge Program + Student Data
        $data = [
            // Program info
            'program_level_id' => $program->program_level_id ?? null,
            'program_description' => $program->program_description ?? null,
            'program_level' => $program->program_level ?? null,
            'program_open_date' => $program->open_date ?? null,
            'program_submission_deadline' => $program->submission_deadline ?? null,
            'intake_name' => $program->intake_name ?? null,
            'field_of_study_id' => $program->field_of_study_id ?? null,
            'field_of_study_name' => $program->field_of_study_name ?? null,
            'study_permit_or_visa' => $program->study_permit_or_visa ?? null,
            'program_nationality' => $program->nationality ?? null,
            'education_country' => $program->education_country ?? null,
            'last_level_of_study' => $program->last_level_of_study ?? null,
            'grading_scheme' => $program->grading_scheme ?? null,

            'ielts_required' => $program->ielts_required ?? false,
            'ielts_reading' => $program->ielts_reading ?? null,
            'ielts_writing' => $program->ielts_writing ?? null,
            'ielts_listening' => $program->ielts_listening ?? null,
            'ielts_speaking' => $program->ielts_speaking ?? null,
            'ielts_overall' => $program->ielts_overall ?? null,

            'toefl_required' => $program->toefl_required ?? false,
            'toefl_overall' => $program->toefl_overall ?? null,

            'duolingo_required' => $program->duolingo_required ?? false,
            'duolingo_total' => $program->duolingo_total ?? null,

            'pte_required' => $program->pte_required ?? false,
            'pte_overall' => $program->pte_overall ?? null,

            'program_tag_id' => $program->program_tag_id ?? null,
            'program_tag_name' => $program->program_tag_name ?? null,

            'application_fee' => $program->application_fee ?? null,
            'campus_city' => $program->campus_city ?? null,
            'duration' => $program->duration ?? null,
            'success_chance' => $program->success_chance ?? null,
            'program_summary' => $program->program_summary ?? null,

            'intake_months' => $program->intake_months ?? [],
            'images' => $program->images ?? [],

            // Student Profile info
            'company_name' => $student->company_name ?? null,
            'email' => $student->email ?? null,
            'destination' => $student->destination ?? null,
            'study_level' => $student->study_level ?? null,
            'subject' => $student->subject ?? null,
            'student_profile_nationality' => $student->nationality ?? null,
            'passport' => $student->passport ?? null,
            'elp' => $student->elp ?? null,
            'dob' => $student->dob ?? null,
            'address' => $student->address ?? null,
            'phone' => $student->phone ?? null,
            'gender' => $student->gender ?? null,
            'passport_expiry' => $student->passport_expiry ?? null,
            'country_of_residence' => $student->country_of_residence ?? null,
            'specialization' => $student->specialization ?? null,

            'sop' => $student->sop ?? null,
            'achievements' => $student->achievements ?? null,
            'resume' => $student->resume ?? null,
            'passport_copy' => $student->passport_copy ?? null,
            'transcripts' => $student->transcripts ?? null,
            'english_test' => $student->english_test ?? null,
            'photo' => $student->photo ?? null,

            'academic_qualifications' => $student->academic_qualifications ?? [],
            'test_scores' => $student->test_scores ?? [],
            'work_experiences' => $student->work_experiences ?? [],
            'references' => $student->references ?? [],
        ];

        // 6️⃣ Strict Status Flow Enforcement
        switch ($application->status) {
            case 'Pending':
                $data['status'] = 'Reviewed';   // Pending → Reviewed
                break;

            case 'Rejected':
                $data['status'] = 'Pending';    // Rejected → Pending (resubmit)
                break;

            case 'Reviewed':
            case 'Accepted':
            case 'Completed':
                // Reviewed, Accepted, Completed → status does not change
                break;
        }

        // 7️⃣ Update Application
        $application->update($data);

        // 8️⃣ Response
        return response()->json([
            'success' => true,
            'message' => 'Application updated successfully',
            'data' => $application->fresh()
        ]);
    }

    

}
