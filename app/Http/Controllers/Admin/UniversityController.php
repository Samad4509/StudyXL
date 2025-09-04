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
   public function edit($id)
    {
        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'status' => false,
                'message' => 'University not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $university
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'status' => false,
                'message' => 'University not found'
            ], 404);
        }

        $data = json_decode($request->getContent(), true);

        $validator = Validator::make($data, [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'string',
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
            'top_disciplines.*' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $university->update($validator->validated());

        return response()->json([
            'status' => true,
            'message' => 'University updated successfully',
            'data' => $university
        ], 200);
    }
     public function destroy($id)
    {
         $university = University::find($id);

        if (!$university) {
            return response()->json([
                'status' => false,
                'message' => 'University not found'
            ], 404);
        }

        $university->delete();

        return response()->json([
            'status' => true,
            'message' => 'University deleted successfully'
        ], 200);
    }

   
}
