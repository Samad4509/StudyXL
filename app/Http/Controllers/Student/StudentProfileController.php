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

            // ✅ Validate input
            $request->validate([
                'dob'              => 'nullable|date',
                'passport_expiry'  => 'nullable|date',
                'email'            => 'nullable|email',
            ]);

            // ✅ Format dates safely (expects YYYY-MM-DD from frontend)
            $dob = $request->filled('dob')
                ? Carbon::createFromFormat('Y-m-d', $request->dob)->format('Y-m-d')
                : null;

            $passportExpiry = $request->filled('passport_expiry')
                ? Carbon::createFromFormat('Y-m-d', $request->passport_expiry)->format('Y-m-d')
                : null;

            // ✅ Handle JSON fields
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

            // ✅ Prepare profile data
            $profileData = [
                'name'                 => $request->input('name', $user->name),
                'email'                => $request->input('email', $user->email),
                'destination'          => $request->input('destination', $user->destination),
                'study_level'          => $request->input('study_level', $user->study_level),
                'subject'              => $request->input('subject', $user->subject),
                'nationality'          => $request->input('nationality', $user->nationality),
                'passport'             => $request->input('passport', $user->passport),
                'elp'                  => $request->input('elp', $user->elp),
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
            ];

            // ✅ Merge JSON fields
            $profileData = array_merge($profileData, $jsonData);

            // ✅ Handle file uploads (save as URL)
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
                    $profileData[$field] = asset($directory . $fileName); // ✅ full URL
                }
            }

            // ✅ Update or create profile
            $profile = StudentProfile::updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.',
                'profile' => $profile,
            ]);
        }

        // ✅ Edit profile
    public function edit()
    {
        $user = Auth::user();
        $profile = StudentProfile::where('user_id', $user->id)->first();

        // Convert stored relative paths to full URLs (backward compatibility)
        if ($profile) {
            $fileFields = ['resume', 'passport_copy', 'transcripts', 'english_test', 'photo'];
            foreach ($fileFields as $field) {
                if ($profile->$field && !str_starts_with($profile->$field, 'http')) {
                    $profile->$field = asset($profile->$field);
                }
            }
        }

        return response()->json([
            'success' => true,
            'user' => $user,
            'profile' => $profile
        ], 200);
    }

    
}
