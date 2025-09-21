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

            // Decode JSON data from request
            $data = json_decode($request->getContent(), true); // decode as associative array

            // Profile fields
            $profileData = [
                'name'         => $data['name'] ?? $user->name,
                'email'        => $data['email'] ?? $user->email,
                'destination'  => $data['destination'] ?? $user->destination,
                'study_level'  => $data['study_level'] ?? $user->study_level,
                'subject'      => $data['subject'] ?? $user->subject,
                'nationality'  => $data['nationality'] ?? $user->nationality,
                'passport'     => $data['passport'] ?? $user->passport,
                'elp'          => $data['elp'] ?? $user->elp,
                'dob'          => $data['dob'] ?? null,
                'address'      => $data['address'] ?? null,
                'phone'        => $data['phone'] ?? null,
                'gender'       => $data['gender'] ?? null,
                'passport_expiry' => $data['passport_expiry'] ?? null,
                'country_of_residence' => $data['country_of_residence'] ?? null,
                'program'      => $data['program'] ?? null,
                'intake'       => $data['intake'] ?? null,
                'specialization' => $data['specialization'] ?? null,
                'qualification'  => $data['qualification'] ?? null,
                'institution'    => $data['institution'] ?? null,
                'year'           => $data['year'] ?? null,
                'cgpa'           => $data['cgpa'] ?? null,
                'test_name'      => $data['test_name'] ?? null,
                'test_score'     => $data['test_score'] ?? null,
                'test_year'      => $data['test_year'] ?? null,
                'organization'   => $data['organization'] ?? null,
                'position'       => $data['position'] ?? null,
                'start_date'     => $data['start_date'] ?? null,
                'end_date'       => $data['end_date'] ?? null,
                'description'    => $data['description'] ?? null,
                'reference_name' => $data['reference_name'] ?? null,
                'reference_email'=> $data['reference_email'] ?? null,
                'reference_relationship'=> $data['reference_relationship'] ?? null,
                'reference_phone'=> $data['reference_phone'] ?? null,
                'sop'            => $data['sop'] ?? null,
                'achievements'   => $data['achievements'] ?? null,
            ];

            // File fields
            $fileFields = [
                'resume'        => 'uploads/resumes/',
                'passport_copy' => 'uploads/passports/',
                'transcripts'   => 'uploads/transcripts/',
                'english_test'  => 'uploads/tests/',
                'photo'         => 'uploads/photos/',
            ];

            $fileData = [];

            foreach ($fileFields as $field => $directory) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    if (!file_exists(public_path($directory))) {
                        mkdir(public_path($directory), 0777, true);
                    }

                    $file->move(public_path($directory), $fileName);

                    $fileData[$field] = $directory . $fileName;
                }
            }

            // Merge file uploads into profile data
            $profileData = array_merge($profileData, $fileData);

            // Update or create profile
            $profile = StudentProfile::updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

            return response()->json([
                'success' => true,
                'profile' => $profile
            ]);
        }

   
}
