<?php

namespace App\Http\Controllers\Admin;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function store(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        // Validation (basic example)
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'string', // URL or filename
            'founded' => 'nullable|integer',
            'school_id' => 'nullable|string',
            'dli_number' => 'nullable|string',
            'institution_type' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'amount_desc' => 'nullable|string',
            'one_year' => 'nullable|numeric',
            'one_year_desc' => 'nullable|string',
            'course_years' => 'nullable|integer',
            'course_years_desc' => 'nullable|string',
            'amount_years' => 'nullable|numeric',
            'amount_years_desc' => 'nullable|string',
            'first_year_amount' => 'nullable|numeric',
            'first_year_desc' => 'nullable|string',
            'application_processing_time' => 'nullable|string',
            'top_disciplines' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $university = University::create($data);

        return response()->json([
            'status' => true,
            'message' => 'University created successfully',
            'data' => $university
        ]);
    }

   
}
