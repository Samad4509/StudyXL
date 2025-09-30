<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldOfStudy;
use App\Models\ProgramLevel;
use Illuminate\Http\Request;
use App\Models\UniversityProgram;
use App\Models\University;

class UniversityProgramController extends Controller
{
    public function index()
    {
         return  $university = University::all();
    }
   

    public function store(Request $request, $university_id,$program_level_id)
    {
        // return $request;
        // Find the university
        $program_level      = ProgramLevel::findOrFail($program_level_id);
       
        // $field_of_studies   = FieldOfStudy::findOrFail($field_of_studies_id);
        $university         = University::findOrFail($university_id); // ensures 404 if not found

        // Optional: validate your request fields
        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
            'program_description' => 'required|string',
            'program_level' => 'nullable|string|max:100',
            'field_of_study' => 'nullable|string|max:255',
            'intake' => 'nullable|string|max:100',
            'program_tag' => 'nullable|string|max:100',
            'application_fee' => 'nullable|string|max:100',
            'application_short_desc' => 'nullable|string|max:255',
            'average_graduate_program' => 'nullable|string|max:255',
            'average_graduate_program_short_desc' => 'nullable|string|max:255',
            'average_undergraduate_program' => 'nullable|string|max:255',
            'average_undergraduate_program_short_desc' => 'nullable|string|max:255',
            'cost_of_living' => 'nullable|string|max:100',
            'cost_of_living_short_desc' => 'nullable|string|max:255',
            'average_gross_tuition' => 'nullable|string|max:100',
            'average_gross_tuition_short_desc' => 'nullable|string|max:255',
            'open_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',

            'students_requirements.study_permit_or_visa' => 'nullable|string',
            'students_requirements.nationality' => 'nullable|string',
            'students_requirements.education_country' => 'nullable|string',
            'students_requirements.last_level_of_study' => 'nullable|string',
            'students_requirements.grading_scheme' => 'nullable|string',

            'students_requirements.english_exam_status.ielts.required' => 'boolean',
            'students_requirements.english_exam_status.ielts.reading' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.writing' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.listening' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.speaking' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.overall' => 'nullable|numeric',

            'students_requirements.english_exam_status.toefl.required' => 'boolean',
            'students_requirements.english_exam_status.toefl.reading' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.writing' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.listening' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.speaking' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.overall' => 'nullable|integer',

            'students_requirements.english_exam_status.duolingo.required' => 'boolean',
            'students_requirements.english_exam_status.duolingo.total' => 'nullable|integer',

            'students_requirements.english_exam_status.pte.required' => 'boolean',
            'students_requirements.english_exam_status.pte.reading' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.writing' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.listening' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.speaking' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.overall' => 'nullable|integer',

            'students_requirements.english_exam_status.no_exam.status' => 'nullable|string',
        ]);

        $req = $request->students_requirements['english_exam_status'];

        $program = UniversityProgram::create([
            // From university table
            'university_name' => $university->university_name,
            'address' => $university->address,
            'location' => $university->location,
            'phone_number' => $university->phone_number,
            'images' => json_encode($university->images),
            'university_id' => $university->id,
            'program_level_id' => $program_level->id,
            'program_name' => $request->program_name,
            'program_description' => $request->program_description,
            'program_level' => $program_level->name ?? null,
            'program_intakes' => $request->intake ?? null,
            'open_date' => $request->open_date,
            'submission_deadline' => $request->submission_deadline,

            // Requirements
            'study_permit_or_visa' => $request->students_requirements['study_permit_or_visa'] ?? null,
            'nationality' => $request->students_requirements['nationality'] ?? null,
            'education_country' => $request->students_requirements['education_country'] ?? null,
            'last_level_of_study' => $request->students_requirements['last_level_of_study'] ?? null,
            'grading_scheme' => $request->students_requirements['grading_scheme'] ?? null,

            // IELTS
            'ielts_required' => $req['ielts']['required'] ?? false,
            'ielts_reading' => $req['ielts']['reading'] ?? null,
            'ielts_writing' => $req['ielts']['writing'] ?? null,
            'ielts_listening' => $req['ielts']['listening'] ?? null,
            'ielts_speaking' => $req['ielts']['speaking'] ?? null,
            'ielts_overall' => $req['ielts']['overall'] ?? null,

            // TOEFL
            'toefl_required' => $req['toefl']['required'] ?? false,
            'toefl_reading' => $req['toefl']['reading'] ?? null,
            'toefl_writing' => $req['toefl']['writing'] ?? null,
            'toefl_listening' => $req['toefl']['listening'] ?? null,
            'toefl_speaking' => $req['toefl']['speaking'] ?? null,
            'toefl_overall' => $req['toefl']['overall'] ?? null,

            // Duolingo
            'duolingo_required' => $req['duolingo']['required'] ?? false,
            'duolingo_total' => $req['duolingo']['total'] ?? null,

            // PTE
            'pte_required' => $req['pte']['required'] ?? false,
            'pte_reading' => $req['pte']['reading'] ?? null,
            'pte_writing' => $req['pte']['writing'] ?? null,
            'pte_listening' => $req['pte']['listening'] ?? null,
            'pte_speaking' => $req['pte']['speaking'] ?? null,
            'pte_overall' => $req['pte']['overall'] ?? null,

            // No Exam
            'no_exam_status' => $req['no_exam']['status'] ?? null,
        ]);

        return response()->json([
            'message' => 'University program created successfully.',
            'program' => $program,
        ], 201);
    }


    public function edit($id)
    {
        $program = UniversityProgram::findOrFail($id);
        return response()->json([
            'program' => $program
        ]);
    } 

    public function update(Request $request, $university_id, $id)
    {
        // Find the university and program
        $university = University::findOrFail($university_id);
        $program = UniversityProgram::findOrFail($id);

        // Validate the request
        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
            'program_description' => 'required|string',
            'program_level' => 'nullable|string|max:100',
            'field_of_study' => 'nullable|string|max:255',
            'intake' => 'nullable|string|max:100',
            'program_tag' => 'nullable|string|max:100',
            'application_fee' => 'nullable|string|max:100',
            'application_short_desc' => 'nullable|string|max:255',
            'average_graduate_program' => 'nullable|string|max:255',
            'average_graduate_program_short_desc' => 'nullable|string|max:255',
            'average_undergraduate_program' => 'nullable|string|max:255',
            'average_undergraduate_program_short_desc' => 'nullable|string|max:255',
            'cost_of_living' => 'nullable|string|max:100',
            'cost_of_living_short_desc' => 'nullable|string|max:255',
            'average_gross_tuition' => 'nullable|string|max:100',
            'average_gross_tuition_short_desc' => 'nullable|string|max:255',
            'open_date' => 'nullable|date',
            'submission_deadline' => 'nullable|date',

            'students_requirements.study_permit_or_visa' => 'nullable|string',
            'students_requirements.nationality' => 'nullable|string',
            'students_requirements.education_country' => 'nullable|string',
            'students_requirements.last_level_of_study' => 'nullable|string',
            'students_requirements.grading_scheme' => 'nullable|string',

            'students_requirements.english_exam_status.ielts.required' => 'boolean',
            'students_requirements.english_exam_status.ielts.reading' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.writing' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.listening' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.speaking' => 'nullable|numeric',
            'students_requirements.english_exam_status.ielts.overall' => 'nullable|numeric',

            'students_requirements.english_exam_status.toefl.required' => 'boolean',
            'students_requirements.english_exam_status.toefl.reading' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.writing' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.listening' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.speaking' => 'nullable|integer',
            'students_requirements.english_exam_status.toefl.overall' => 'nullable|integer',

            'students_requirements.english_exam_status.duolingo.required' => 'boolean',
            'students_requirements.english_exam_status.duolingo.total' => 'nullable|integer',

            'students_requirements.english_exam_status.pte.required' => 'boolean',
            'students_requirements.english_exam_status.pte.reading' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.writing' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.listening' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.speaking' => 'nullable|integer',
            'students_requirements.english_exam_status.pte.overall' => 'nullable|integer',

            'students_requirements.english_exam_status.no_exam.status' => 'nullable|string',
        ]);

        $req = $request->students_requirements['english_exam_status'] ?? [];

        // Update program fields
        $program->update([
            // University info (optional, if you want to sync)
            'university_name' => $university->university_name,
            'address' => $university->address,
            'location' => $university->location,
            'phone_number' => $university->phone_number,
            'images' => json_encode($university->images),
            'university_id' => $university->id,
            // Program info
            'program_name' => $request->program_name,
            'program_description' => $request->program_description,
            'program_level' => $request->program_level ?? null,
            'program_intakes' => $request->intake ?? null,
            'open_date' => $request->open_date,
            'submission_deadline' => $request->submission_deadline,

            // Requirements
            'study_permit_or_visa' => $request->students_requirements['study_permit_or_visa'] ?? null,
            'nationality' => $request->students_requirements['nationality'] ?? null,
            'education_country' => $request->students_requirements['education_country'] ?? null,
            'last_level_of_study' => $request->students_requirements['last_level_of_study'] ?? null,
            'grading_scheme' => $request->students_requirements['grading_scheme'] ?? null,

            // IELTS
            'ielts_required' => $req['ielts']['required'] ?? false,
            'ielts_reading' => $req['ielts']['reading'] ?? null,
            'ielts_writing' => $req['ielts']['writing'] ?? null,
            'ielts_listening' => $req['ielts']['listening'] ?? null,
            'ielts_speaking' => $req['ielts']['speaking'] ?? null,
            'ielts_overall' => $req['ielts']['overall'] ?? null,

            // TOEFL
            'toefl_required' => $req['toefl']['required'] ?? false,
            'toefl_reading' => $req['toefl']['reading'] ?? null,
            'toefl_writing' => $req['toefl']['writing'] ?? null,
            'toefl_listening' => $req['toefl']['listening'] ?? null,
            'toefl_speaking' => $req['toefl']['speaking'] ?? null,
            'toefl_overall' => $req['toefl']['overall'] ?? null,

            // Duolingo
            'duolingo_required' => $req['duolingo']['required'] ?? false,
            'duolingo_total' => $req['duolingo']['total'] ?? null,

            // PTE
            'pte_required' => $req['pte']['required'] ?? false,
            'pte_reading' => $req['pte']['reading'] ?? null,
            'pte_writing' => $req['pte']['writing'] ?? null,
            'pte_listening' => $req['pte']['listening'] ?? null,
            'pte_speaking' => $req['pte']['speaking'] ?? null,
            'pte_overall' => $req['pte']['overall'] ?? null,

            // No Exam
            'no_exam_status' => $req['no_exam']['status'] ?? null,
        ]);

        return response()->json([
            'message' => 'University program updated successfully.',
            'program' => $program,
        ], 200);
    }

    
    public function destroy($university_id, $id)
    {
        // Optional: validate university exists
        $university = University::findOrFail($university_id);

        // Find the program
        $program = UniversityProgram::where('university_id', $university_id)
            ->where('id', $id)
            ->firstOrFail();

        // Delete the program
        $program->delete();

        return response()->json([
            'message' => 'University program deleted successfully.'
        ], 200);
    }



}
