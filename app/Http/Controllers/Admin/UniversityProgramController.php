<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UniversityProgram;
use App\Models\University;

class UniversityProgramController extends Controller
{
    public function store(Request $request)
    {

        // return $request;
        // Validate request
        $validatedData = $request->validate([
            'university_id' => 'required|exists:universities,id',
            'program_name' => 'required|string|max:255',
            'program_description' => 'required|string',
            'program_intakes' => 'nullable|string',
            'open_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',
        ]);

        // Retrieve the university
      $university = University::find($validatedData['university_id']);

        // Create the program linked to university
        $program = $university->programs()->create([
            'program_name' => $validatedData['program_name'],
            'program_description' => $validatedData['program_description'],
            'program_intakes' => $validatedData['program_intakes'] ?? null,
            'open_date' => $validatedData['open_date'] ?? null,
            'submission_deadline' => $validatedData['submission_deadline'] ?? null,
        ]);

        // Return JSON response including university details
        return response()->json([
            'status' => true,
            'message' => 'Program created successfully',
            'data' => [
                'program' => $program,
                'university' => $university
            ]
        ], 201);
    }
}
