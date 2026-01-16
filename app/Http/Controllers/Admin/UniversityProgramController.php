<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldOfStudy;
use App\Models\Intake;
use App\Models\IntakeMonth;
use App\Models\ProgramLevel;
use App\Models\ProgramTag;
use Illuminate\Http\Request;
use App\Models\UniversityProgram;
use App\Models\University;

class UniversityProgramController extends Controller
{
    public function index()
    {
        return  $university = UniversityProgram::all();
    }


    public function store(Request $request, $university_id, $program_level_id, $field_of_studies_id, $intake_id, $intake_month_id, $program_tag_id)
    {

        // return $request;
        $program_tag = ProgramTag::findOrFail($program_tag_id);
        $intake_month = IntakeMonth::findOrFail($intake_month_id);
        $intake = Intake::with('months')->findOrFail($intake_id);


        $field_of_studies = FieldOfStudy::findOrFail($field_of_studies_id);
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
            'open_date' => $request->open_date,
            'submission_deadline' => $request->submission_deadline,
            'intake_months' => [$intake_month],
            //Intake 
            'intake_name' => $intake->name,
            'intake_id' => $intake->id,

            //Program Tag
            'program_tag_id' => $program_tag->id,
            'program_tag_name' => $program_tag->program_tag,
            //Field Of Study
            'field_of_study_name' => $field_of_studies->name,
            'field_of_study_id'   => $field_of_studies->id,

            'success_chance'   => $request->success_chance,
            'program_summary'   => $request->program_summary,

            'application_fee' => $request->application_fee ?? null,
            'campus_city' => $request->campus_city ?? null,
            'duration' => $request->duration ?? null,
            'application_short_desc' => $request->application_short_desc ?? null,
            'average_graduate_program' => $request->average_graduate_program ?? null,
            'average_graduate_program_short_desc' => $request->average_graduate_program_short_desc ?? null,
            'average_undergraduate_program' => $request->average_undergraduate_program ?? null,
            'average_undergraduate_program_short_desc' => $request->average_undergraduate_program_short_desc ?? null,
            'cost_of_living' => $request->cost_of_living ?? null,
            'cost_of_living_short_desc' => $request->cost_of_living_short_desc ?? null,
            'average_gross_tuition' => $request->average_gross_tuition ?? null,
            'average_gross_tuition_short_desc' => $request->average_gross_tuition_short_desc ?? null,


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

    // public function update(Request $request, $university_id, $id)
    // {
    //     // Find the university and program
    //     $university = University::findOrFail($university_id);
    //     $program = UniversityProgram::findOrFail($id);

    //     // Validate the request
    //     $validated = $request->validate([
    //         'program_name' => 'required|string|max:255',
    //         'program_description' => 'required|string',
    //         'program_level' => 'nullable|string|max:100',
    //         'field_of_study' => 'nullable|string|max:255',
    //         'intake' => 'nullable|string|max:100',
    //         'program_tag' => 'nullable|string|max:100',
    //         'application_fee' => 'nullable|string|max:100',
    //         'application_short_desc' => 'nullable|string|max:255',
    //         'average_graduate_program' => 'nullable|string|max:255',
    //         'average_graduate_program_short_desc' => 'nullable|string|max:255',
    //         'average_undergraduate_program' => 'nullable|string|max:255',
    //         'average_undergraduate_program_short_desc' => 'nullable|string|max:255',
    //         'cost_of_living' => 'nullable|string|max:100',
    //         'cost_of_living_short_desc' => 'nullable|string|max:255',
    //         'average_gross_tuition' => 'nullable|string|max:100',
    //         'average_gross_tuition_short_desc' => 'nullable|string|max:255',
    //         'open_date' => 'nullable|date',
    //         'submission_deadline' => 'nullable|date',

    //         'students_requirements.study_permit_or_visa' => 'nullable|string',
    //         'students_requirements.nationality' => 'nullable|string',
    //         'students_requirements.education_country' => 'nullable|string',
    //         'students_requirements.last_level_of_study' => 'nullable|string',
    //         'students_requirements.grading_scheme' => 'nullable|string',

    //         'students_requirements.english_exam_status.ielts.required' => 'boolean',
    //         'students_requirements.english_exam_status.ielts.reading' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.writing' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.listening' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.speaking' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.overall' => 'nullable|numeric',

    //         'students_requirements.english_exam_status.toefl.required' => 'boolean',
    //         'students_requirements.english_exam_status.toefl.reading' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.writing' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.listening' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.speaking' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.overall' => 'nullable|integer',

    //         'students_requirements.english_exam_status.duolingo.required' => 'boolean',
    //         'students_requirements.english_exam_status.duolingo.total' => 'nullable|integer',

    //         'students_requirements.english_exam_status.pte.required' => 'boolean',
    //         'students_requirements.english_exam_status.pte.reading' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.writing' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.listening' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.speaking' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.overall' => 'nullable|integer',

    //         'students_requirements.english_exam_status.no_exam.status' => 'nullable|string',
    //     ]);

    //     $req = $request->students_requirements['english_exam_status'] ?? [];

    //     // Update program fields
    //     $program->update([
    //         // University info (optional, if you want to sync)
    //         'university_name' => $university->university_name,
    //         'address' => $university->address,
    //         'location' => $university->location,
    //         'phone_number' => $university->phone_number,
    //         'images' => json_encode($university->images),
    //         'university_id' => $university->id,
    //         // Program info
    //         'program_name' => $request->program_name,
    //         'program_description' => $request->program_description,
    //         'program_level' => $request->program_level ?? null,
    //         'open_date' => $request->open_date,
    //         'submission_deadline' => $request->submission_deadline,

    //         // Requirements
    //         'study_permit_or_visa' => $request->students_requirements['study_permit_or_visa'] ?? null,
    //         'nationality' => $request->students_requirements['nationality'] ?? null,
    //         'education_country' => $request->students_requirements['education_country'] ?? null,
    //         'last_level_of_study' => $request->students_requirements['last_level_of_study'] ?? null,
    //         'grading_scheme' => $request->students_requirements['grading_scheme'] ?? null,

    //         // IELTS
    //         'ielts_required' => $req['ielts']['required'] ?? false,
    //         'ielts_reading' => $req['ielts']['reading'] ?? null,
    //         'ielts_writing' => $req['ielts']['writing'] ?? null,
    //         'ielts_listening' => $req['ielts']['listening'] ?? null,
    //         'ielts_speaking' => $req['ielts']['speaking'] ?? null,
    //         'ielts_overall' => $req['ielts']['overall'] ?? null,

    //         // TOEFL
    //         'toefl_required' => $req['toefl']['required'] ?? false,
    //         'toefl_reading' => $req['toefl']['reading'] ?? null,
    //         'toefl_writing' => $req['toefl']['writing'] ?? null,
    //         'toefl_listening' => $req['toefl']['listening'] ?? null,
    //         'toefl_speaking' => $req['toefl']['speaking'] ?? null,
    //         'toefl_overall' => $req['toefl']['overall'] ?? null,

    //         // Duolingo
    //         'duolingo_required' => $req['duolingo']['required'] ?? false,
    //         'duolingo_total' => $req['duolingo']['total'] ?? null,

    //         // PTE
    //         'pte_required' => $req['pte']['required'] ?? false,
    //         'pte_reading' => $req['pte']['reading'] ?? null,
    //         'pte_writing' => $req['pte']['writing'] ?? null,
    //         'pte_listening' => $req['pte']['listening'] ?? null,
    //         'pte_speaking' => $req['pte']['speaking'] ?? null,
    //         'pte_overall' => $req['pte']['overall'] ?? null,

    //         // No Exam
    //         'no_exam_status' => $req['no_exam']['status'] ?? null,
    //     ]);

    //     return response()->json([
    //         'message' => 'University program updated successfully.',
    //         'program' => $program,
    //     ], 200);
    // }

    // public function update(Request $request, $id, $university_id, $program_level_id, $field_of_studies_id, $intake_id, $intake_month_id, $program_tag_id)
    // {
    //     // return $university_id;
    //     $program = UniversityProgram::findOrFail($id);

    //     $program_tag = ProgramTag::findOrFail($program_tag_id);
    //     $intake_month = IntakeMonth::findOrFail($intake_month_id);
    //     $intake = Intake::with('months')->findOrFail($intake_id);
    //     $field_of_studies = FieldOfStudy::findOrFail($field_of_studies_id);
    //     $program_level = ProgramLevel::findOrFail($program_level_id);
    //     $university = University::findOrFail($university_id);

    //     // Validate input
    //     $validated = $request->validate([
    //         'program_name' => 'required|string|max:255',
    //         'program_description' => 'required|string',
    //         'open_date' => 'nullable|date',
    //         'submission_deadline' => 'nullable|date',

    //         // Nested requirements
    //         'students_requirements.study_permit_or_visa' => 'nullable|string',
    //         'students_requirements.nationality' => 'nullable|string',
    //         'students_requirements.education_country' => 'nullable|string',
    //         'students_requirements.last_level_of_study' => 'nullable|string',
    //         'students_requirements.grading_scheme' => 'nullable|string',

    //         'students_requirements.english_exam_status.ielts.required' => 'boolean',
    //         'students_requirements.english_exam_status.ielts.reading' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.writing' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.listening' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.speaking' => 'nullable|numeric',
    //         'students_requirements.english_exam_status.ielts.overall' => 'nullable|numeric',

    //         'students_requirements.english_exam_status.toefl.required' => 'boolean',
    //         'students_requirements.english_exam_status.toefl.reading' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.writing' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.listening' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.speaking' => 'nullable|integer',
    //         'students_requirements.english_exam_status.toefl.overall' => 'nullable|integer',

    //         'students_requirements.english_exam_status.duolingo.required' => 'boolean',
    //         'students_requirements.english_exam_status.duolingo.total' => 'nullable|integer',

    //         'students_requirements.english_exam_status.pte.required' => 'boolean',
    //         'students_requirements.english_exam_status.pte.reading' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.writing' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.listening' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.speaking' => 'nullable|integer',
    //         'students_requirements.english_exam_status.pte.overall' => 'nullable|integer',

    //         'students_requirements.english_exam_status.no_exam.status' => 'nullable|string',
    //     ]);

    //     $req = $request->students_requirements['english_exam_status'] ?? [];

    //     $program->update([
    //         // University
    //         'university_name' => $university->university_name,
    //         'address' => $university->address,
    //         'location' => $university->location,
    //         'phone_number' => $university->phone_number,
    //         'images' => json_encode($university->images),
    //         'university_id' => $university->id,

    //         // Program info
    //         'program_level_id' => $program_level->id,
    //         'program_name' => $request->program_name,
    //         'program_description' => $request->program_description,
    //         'program_level' => $program_level->name ?? null,
    //         'open_date' => $request->open_date,
    //         'submission_deadline' => $request->submission_deadline,

    //         // Intake
    //         'intake_months' => [$intake_month],
    //         'intake_name' => $intake->name,
    //         'intake_id' => $intake->id,

    //         // Program Tag
    //         'program_tag_id' => $program_tag->id,
    //         'program_tag_name' => $program_tag->program_tag,

    //         // Field of Study
    //         'field_of_study_name' => $field_of_studies->name,
    //         'field_of_study_id' => $field_of_studies->id,

    //         // Requirements
    //         'study_permit_or_visa' => $request->students_requirements['study_permit_or_visa'] ?? null,
    //         'nationality' => $request->students_requirements['nationality'] ?? null,
    //         'education_country' => $request->students_requirements['education_country'] ?? null,
    //         'last_level_of_study' => $request->students_requirements['last_level_of_study'] ?? null,
    //         'grading_scheme' => $request->students_requirements['grading_scheme'] ?? null,

    //         // IELTS
    //         'ielts_required' => $req['ielts']['required'] ?? false,
    //         'ielts_reading' => $req['ielts']['reading'] ?? null,
    //         'ielts_writing' => $req['ielts']['writing'] ?? null,
    //         'ielts_listening' => $req['ielts']['listening'] ?? null,
    //         'ielts_speaking' => $req['ielts']['speaking'] ?? null,
    //         'ielts_overall' => $req['ielts']['overall'] ?? null,

    //         // TOEFL
    //         'toefl_required' => $req['toefl']['required'] ?? false,
    //         'toefl_reading' => $req['toefl']['reading'] ?? null,
    //         'toefl_writing' => $req['toefl']['writing'] ?? null,
    //         'toefl_listening' => $req['toefl']['listening'] ?? null,
    //         'toefl_speaking' => $req['toefl']['speaking'] ?? null,
    //         'toefl_overall' => $req['toefl']['overall'] ?? null,

    //         // Duolingo
    //         'duolingo_required' => $req['duolingo']['required'] ?? false,
    //         'duolingo_total' => $req['duolingo']['total'] ?? null,

    //         // PTE
    //         'pte_required' => $req['pte']['required'] ?? false,
    //         'pte_reading' => $req['pte']['reading'] ?? null,
    //         'pte_writing' => $req['pte']['writing'] ?? null,
    //         'pte_listening' => $req['pte']['listening'] ?? null,
    //         'pte_speaking' => $req['pte']['speaking'] ?? null,
    //         'pte_overall' => $req['pte']['overall'] ?? null,

    //         // No Exam
    //         'no_exam_status' => $req['no_exam']['status'] ?? null,
    //     ]);

    //     return response()->json([
    //         'message' => 'University program updated successfully.',
    //         'program' => $program,
    //     ], 200);
    // }
//University Program Update
    public function update(Request $request, $university_id, $program_level_id, $field_of_studies_id, $intake_id, $intake_month_id, $program_tag_id, $program_id)

    {
        $program = UniversityProgram::findOrFail($program_id);

        $program_tag      = ProgramTag::findOrFail($program_tag_id);
        $intake_month     = IntakeMonth::findOrFail($intake_month_id);
        $intake           = Intake::with('months')->findOrFail($intake_id);
        $field_of_studies = FieldOfStudy::findOrFail($field_of_studies_id);
        $program_level    = ProgramLevel::findOrFail($program_level_id);
        $university       = University::findOrFail($university_id);

        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
            'program_description' => 'required|string',
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

        $program->update([
            // University
            'university_name' => $university->university_name,
            'address' => $university->address,
            'location' => $university->location,
            'phone_number' => $university->phone_number,
            'images' => json_encode($university->images),
            'university_id' => $university->id,

            // Program info
            'program_level_id' => $program_level->id,
            'program_name' => $request->program_name,
            'program_description' => $request->program_description,
            'program_level' => $program_level->name,
            'open_date' => $request->open_date,
            'submission_deadline' => $request->submission_deadline,

            // Intake
            'intake_name' => $intake->name,
            'intake_id' => $intake->id,
            'intake_months' => [$intake_month],

            // Program tag
            'program_tag_id' => $program_tag->id,
            'program_tag_name' => $program_tag->program_tag,

            // Field of study
            'field_of_study_id' => $field_of_studies->id,
            'field_of_study_name' => $field_of_studies->name,

            // Extras
            'success_chance' => $request->success_chance,
            'program_summary' => $request->program_summary,
            'application_fee' => $request->application_fee,
            'campus_city' => $request->campus_city,
            'duration' => $request->duration,

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

            // No exam
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

    public function programdetails($id)
    {
       return $programdetails = UniversityProgram::find($id);
    }

        public function getByUniversity($university_id)
    {
        // University exists check (optional but recommended)
        $university = University::find($university_id);

        if (!$university) {
            return response()->json([
                'success' => false,
                'message' => 'University not found'
            ], 404);
        }

        $programs = UniversityProgram::where('university_id', $university_id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'university' => [
                'id' => $university->id,
                'name' => $university->university_name,
            ],
            'count' => $programs->count(),
            'programs' => $programs
        ]);
    }

}
