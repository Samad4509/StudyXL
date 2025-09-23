<?php
namespace App\Http\Controllers\Student;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
  

  public function update(Request $request)
    {
        $user = Auth::user();

        
        // ✅ Step 2: Format dates to Y-m-d
        $dob = $request->filled('dob')
            ? Carbon::createFromFormat('m-d-Y', $request->dob)->format('Y-m-d')
            : null;

        $passportExpiry = $request->filled('passport_expiry')
            ? Carbon::createFromFormat('m-d-Y', $request->passport_expiry)->format('Y-m-d')
            : null;

        // ✅ Step 3: Handle array inputs (optional: handle raw JSON from form-data)
        $jsonFields = ['academic_qualifications', 'test_scores', 'work_experiences', 'references'];
        $jsonData = [];

        foreach ($jsonFields as $field) {
            $value = $request->input($field);
            if (is_string($value)) {
                $decoded = json_decode($value, true);
                $jsonData[$field] = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
            } else {
                $jsonData[$field] = $value;
            }
        }

        // ✅ Step 4: Prepare all profile fields
        $profileData = [
            'name'                   => $request->input('name', $user->name),
            'email'                  => $request->input('email', $user->email),
            'destination'            => $request->input('destination', $user->destination),
            'study_level'            => $request->input('study_level', $user->study_level),
            'subject'                => $request->input('subject', $user->subject),
            'nationality'            => $request->input('nationality', $user->nationality),
            'passport'               => $request->input('passport', $user->passport),
            'elp'                    => $request->input('elp', $user->elp),
            'dob'                    => $dob,
            'address'                => $request->input('address'),
            'phone'                  => $request->input('phone'),
            'gender'                 => $request->input('gender'),
            'passport_expiry'        => $passportExpiry,
            'country_of_residence'   => $request->input('country_of_residence'),
            'program'                => $request->input('program'),
            'intake'                 => $request->input('intake'),
            'specialization'         => $request->input('specialization'),
            'sop'                    => $request->input('sop'),
            'achievements'           => $request->input('achievements'),
        ];

        // ✅ Add JSON fields to profile data
        $profileData = array_merge($profileData, $jsonData);

        // ✅ Step 5: Handle file uploads
        $fileFields = [
            'resume'        => 'uploads/resumes/',
            'passport_copy' => 'uploads/passports/',
            'transcripts'   => 'uploads/transcripts/',
            'english_test'  => 'uploads/tests/',
            'photo'         => 'uploads/photos/',
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

        // ✅ Step 6: Update or create student profile
        $profile = StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.',
            'profile' => $profile
        ]);
    }

    // Edit profile
    public function edit()
    {
        $user = Auth::user();
        $profile = StudentProfile::where('user_id', $user->id)->first();

        return response()->json([
            'success' => true,
            'user' => $user,
            'profile' => $profile
        ], 200);
    }
}
