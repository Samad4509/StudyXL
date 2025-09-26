<?php

namespace App\Http\Controllers\Agent;

use Carbon\Carbon;

use App\Models\AgentStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AgentStudentController extends Controller
{

   public function index()
    {
        $agentstudent = AgentStudent::all();
        return response()->json([
            'success' => true,
            'message' => 'Agent students retrieved successfully',
            'data' => $agentstudent
        ]);
    }

    public function store(Request $request)
    {
        $agent = Auth::guard('token')->user();

        if (!$agent) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please login again.'
            ], 401);
        }

        // ✅ Basic validation
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // ✅ Format dates safely
        $dob = $request->filled('dob') ? date('Y-m-d', strtotime($request->dob)) : null;
        $passportExpiry = $request->filled('passport_expiry') ? date('Y-m-d', strtotime($request->passport_expiry)) : null;

        // ✅ Prepare profile data
        $profileData = [
            'agent_id'             => $agent->id,
            'company_name'         => $request->input('company_name', $agent->company_name),
            'name'                 => $request->input('name'),
            'email'                => $request->input('email'),
            'destination'          => $request->input('destination'),
            'study_level'          => $request->input('study_level'),
            'subject'              => $request->input('subject'),
            'nationality'          => $request->input('nationality'),
            'passport'             => $request->input('passport'),
            'elp'                  => $request->input('elp'),
            'dob'                  => $dob,
            'address'              => $request->input('address'),
            'phone'                => $request->input('phone'),
            'gender'               => $request->input('gender'),
            'passport_expiry'      => $passportExpiry,
            'country_of_residence' => $request->input('country_of_residence'),
            'program'              => $request->input('program'),
            'intake'               => $request->input('intake'),
            'specialization'       => $request->input('specialization'),
            'sop'                  => $request->input('sop'),
            'achievements'         => $request->input('achievements'),
            'academic_qualifications' => $request->input('academic_qualifications', []),
            'test_scores'             => $request->input('test_scores', []),
            'work_experiences'        => $request->input('work_experiences', []),
            'references'              => $request->input('references', []),
        ];

        // ✅ Handle file uploads (normal process, move to public/uploads)
        $fileFields = [
            'resume'        => 'uploads/agent-student/resumes/',
            'passport_copy' => 'uploads/agent-student/passports/',
            'transcripts'   => 'uploads/agent-student/transcripts/',
            'english_test'  => 'uploads/agent-student/tests/',
            'photo'         => 'uploads/agent-student/photos/',
        ];

        foreach ($fileFields as $field => $directory) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $file->getClientOriginalName();

                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0777, true);
                }

                $file->move(public_path($directory), $fileName);
                $profileData[$field] = $directory . $fileName;
            }
        }

        // ✅ Save profile
        $profile = AgentStudent::create($profileData);

        return response()->json([
            'success' => true,
            'message' => 'Student profile created successfully.',
            'profile' => $profile,
        ], 201);
    }


   public function edit($id)
    {
        $profile = AgentStudent::findOrFail($id);

        return response()->json([
            'success' => true,
            'profile' => $profile
        ]);
    }

    public function update(Request $request, $id)
    {
        // return $id;
        $agent = Auth::guard('token')->user();

        // Find student profile, ensure it belongs to this agent
        $profile = AgentStudent::where('agent_id', $agent->id)->findOrFail($id);

        // Format dates if provided
        if ($request->filled('dob')) {
            $profile->dob = Carbon::createFromFormat('m-d-Y', $request->dob)->format('Y-m-d');
        }

        if ($request->filled('passport_expiry')) {
            $profile->passport_expiry = Carbon::createFromFormat('m-d-Y', $request->passport_expiry)->format('Y-m-d');
        }

        // Handle JSON fields
        $jsonFields = ['academic_qualifications', 'test_scores', 'work_experiences', 'references'];
        foreach ($jsonFields as $field) {
            if ($request->has($field)) {
                $value = $request->input($field);
                if (is_string($value)) {
                    $decoded = json_decode($value, true);
                    $profile->$field = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
                } else {
                    $profile->$field = $value ?? [];
                }
            }
        }

        // Update normal fields if provided
        $fields = [
            'company_name','name','email','destination','study_level','subject','nationality',
            'passport','elp','address','phone','gender','country_of_residence','program','intake',
            'specialization','sop','achievements'
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $profile->$field = $request->input($field);
            }
        }

        // Handle file uploads
        $fileFields = [
            'resume'        => 'uploads/agent-student/resumes/',
            'passport_copy' => 'uploads/agent-student/passports/',
            'transcripts'   => 'uploads/agent-student/transcripts/',
            'english_test'  => 'uploads/agent-student/tests/',
            'photo'         => 'uploads/agent-student/photos/',
        ];

        foreach ($fileFields as $field => $directory) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $fileName = time() . '_' . $file->getClientOriginalName();

                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0777, true);
                }

                $file->move(public_path($directory), $fileName);
                $profile->$field = $directory . $fileName;
            }
        }

        // Save changes
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Student profile updated successfully.',
            'profile' => $profile
        ]);
    }
    public function destroy($id)
    {
        $agent = Auth::guard('token')->user();

        // Find the student profile and ensure it belongs to the agent
        $profile = AgentStudent::where('agent_id', $agent->id)->findOrFail($id);

        // List of file fields to delete
        $fileFields = ['resume','passport_copy','transcripts','english_test','photo'];

        foreach ($fileFields as $field) {
            if (!empty($profile->$field) && file_exists(public_path($profile->$field))) {
                unlink(public_path($profile->$field)); // Delete the file
            }
        }

        // Delete the profile record
        $profile->delete();

        return response()->json([
            'success' => true,
            'message' => 'Student profile and related files deleted successfully.'
        ]);
    }



}
