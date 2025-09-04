<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentProfile;

class StudentProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // Merge user info + request data
        $updateData = array_merge(
            ['user_id' => $user->id],
            $request->only([
                'full_name', 'dob', 'gender', 'phone', 'email', 'address',
                'passport_number', 'passport_expiry', 'nationality', 'country_of_residence',
                'desired_program', 'preferred_intake', 'study_level', 'specialization',
                'qualification', 'institution', 'year', 'cgpa',
                'sop', 'extracurricular'
            ])
        );

        // 🔹 File fields and target directories
        $fileFields = [
            'resume'        => 'uploads/resumes/',
            'passport_copy' => 'uploads/passports/',
            'transcripts'   => 'uploads/transcripts/',
            'english_test'  => 'uploads/tests/',
            'photo'         => 'uploads/photos/',
        ];

        // 🔹 Handle all file uploads in a loop
        foreach ($fileFields as $field => $directory) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Create unique file name
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Ensure directory exists
                if (!file_exists(public_path($directory))) {
                    mkdir(public_path($directory), 0777, true);
                }

                // Move file to public/uploads/{type}/
                $file->move(public_path($directory), $fileName);

                // Save relative path in DB
                $updateData[$field] = $directory . $fileName;
            }
        }

        // Save into DB (update if exists, create if not)
        $profile = StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            $updateData
        );

        return response()->json([
            'status'  => 'ok',
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ]);
    }
}
