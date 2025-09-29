<?php

namespace App\Http\Controllers\Admin;

use App\Models\University;
use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function universitydestination()
    {
        $alldestination = Destination::all();

        return response()->json([
            'status' => true,
            'data' => $alldestination
        ]);
    }

    public function alluniversitie()
    {
        $alluniversities = University::all();

        return response()->json([
            'status' => true,
            'data' => $alluniversities
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'university_name' => 'required|unique:universities,university_name',
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
            'founded' => 'nullable|integer',
            'school_id' => 'nullable|string',
            'institution_type' => 'nullable|string',
            'dli_number' => 'nullable|string',
            'top_disciplines' => 'nullable|string',
            'application_fee' => 'nullable|string',
            'application_short_desc' => 'nullable|string',
            'average_graduate_program' => 'nullable|string',
            'average_graduate_program_short_desc' => 'nullable|string',
            'average_undergraduate_program' => 'nullable|string',
            'average_undergraduate_program_short_desc' => 'nullable|string',
            'cost_of_living' => 'nullable|string',
            'cost_of_living_short_desc' => 'nullable|string',
            'average_gross_tuition' => 'nullable|string',
            'average_gross_tuition_short_desc' => 'nullable|string',
            'destinations' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->except('images', 'top_disciplines');

        // Handle images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = 'img_' . time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/universities'), $fileName);
                $imagePaths[] = 'uploads/universities/' . $fileName;
            }
        }
        $data['images'] = $imagePaths;

        // Handle top_disciplines JSON
        if ($request->filled('top_disciplines')) {
            $decoded = json_decode($request->top_disciplines, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['top_disciplines'] = $decoded;
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => ['top_disciplines' => ['Invalid JSON format']],
                ], 422);
            }
        }

        // Create University
        $university = University::create($data);

        return response()->json([
            'status' => true,
            'message' => 'University created successfully',
            'data' => $university,
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
                'message' => 'University not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'university_name' => 'required|string|max:255|unique:universities,university_name,' . $id,
            'address' => 'nullable|string',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:jpg,jpeg,png,webp|max:2048',
            'founded' => 'nullable|integer',
            'school_id' => 'nullable|string',
            'institution_type' => 'nullable|string',
            'dli_number' => 'nullable|string',
            'top_disciplines' => 'nullable|string',
            'application_fee' => 'nullable|string',
            'application_short_desc' => 'nullable|string',
            'average_graduate_program' => 'nullable|string',
            'average_graduate_program_short_desc' => 'nullable|string',
            'average_undergraduate_program' => 'nullable|string',
            'average_undergraduate_program_short_desc' => 'nullable|string',
            'cost_of_living' => 'nullable|string',
            'cost_of_living_short_desc' => 'nullable|string',
            'average_gross_tuition' => 'nullable|string',
            'average_gross_tuition_short_desc' => 'nullable|string',
            'destinations' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->except('images', 'top_disciplines');

        if ($request->hasFile('images')) {
            // Delete old images
            if (!empty($university->images) && is_array($university->images)) {
                foreach ($university->images as $oldImagePath) {
                    $fullPath = public_path($oldImagePath);
                    if (file_exists($fullPath)) {
                        @unlink($fullPath);
                    }
                }
            }

            // Upload new images
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $fileName = 'img_' . time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/universities'), $fileName);
                $newImagePaths[] = 'uploads/universities/' . $fileName;
            }
            $data['images'] = $newImagePaths;
        }

        if ($request->filled('top_disciplines')) {
            $decoded = json_decode($request->top_disciplines, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['top_disciplines'] = $decoded;
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => ['top_disciplines' => ['Invalid JSON format']],
                ], 422);
            }
        }

        $university->update($data);

        return response()->json([
            'status' => true,
            'message' => 'University updated successfully',
            'data' => $university,
        ]);
    }

    public function destroy($id)
    {
        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'status' => false,
                'message' => 'University not found',
            ], 404);
        }

        // Delete associated images
        if (!empty($university->images) && is_array($university->images)) {
            foreach ($university->images as $imagePath) {
                $fullPath = public_path($imagePath);
                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
        }

        $university->delete();

        return response()->json([
            'status' => true,
            'message' => 'University deleted successfully',
        ]);
    }
}