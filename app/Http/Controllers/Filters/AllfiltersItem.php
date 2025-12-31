<?php

namespace App\Http\Controllers\Filters;

use App\Models\Intake;
use App\Models\ProgramTag;
use App\Models\University;
use App\Models\Destination;
use App\Models\IntakeMonth;
use App\Models\AgentStudent;
use App\Models\FieldOfStudy;
use App\Models\ProgramLevel;
use Illuminate\Http\Request;
use App\Models\FieldOFSubject;
use App\Models\UniversityProgram;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AllfiltersItem extends Controller
{
    public function Programlevel(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $programLevel = ProgramLevel::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Program Level created successfully.',
            'data' => $programLevel
        ], 201);
    }

    public function Programleveledit($id)
    {
        return $programLevel = ProgramLevel::find($id);
    }


    public function Programlevelupdate(Request $request, $id)
    {
        Log::info('Incoming update request:', $request->all());  // Debug

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $programLevel = ProgramLevel::find($id);

        if (!$programLevel) {
            return response()->json(['error' => 'Program Level not found.'], 404);
        }

        $programLevel->name = $request->input('name');
        $programLevel->save();

        return response()->json($programLevel, 200);
    }

    public function Programleveldestroy($id)
    {
        $programLevel = ProgramLevel::find($id);

        if (!$programLevel) {
            return response()->json(['error' => 'Program Level not found.'], 404);
        }

        $programLevel->delete();

        return response()->json(['message' => 'Program Level deleted successfully.'], 200);
    }

    public function AllProgramlevel()
    {
        return  $allprogrum = ProgramLevel::get();
    }

    public function FieldOfstudy(Request $request)
    {
        // return $request;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $programLevel = FieldOfStudy::create($validated);

        return response()->json([
            'success' => true,
            'message' => ' Field Of Study created successfully.',
            'data' => $programLevel
        ], 201);
    }

    public function FieldOfstudyedit($id)
    {
        return $programLevel = FieldOfStudy::find($id);
    }

    public function FieldOfstudyupdate(Request $request, $id)
    {

        Log::info('Incoming update request:', $request->all());  // Debug

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $programLevel = FieldOfStudy::find($id);

        if (!$programLevel) {
            return response()->json(['error' => 'Field Of Study Level not found.'], 404);
        }

        $programLevel->name = $request->input('name');
        $programLevel->save();

        return response()->json($programLevel, 200);
    }

    public function FieldOfstudydelete($id)
    {
        $FieldOfstudy = FieldOfStudy::find($id);

        if (!$FieldOfstudy) {
            return response()->json(['error' => 'Field Of Study not found.'], 404);
        }

        $FieldOfstudy->delete();
        return response()->json(['message' => 'Field Of Study  deleted successfully.'], 200);
    }

    public function AllFieldOfstudy()
    {
        return  $allprogrum = FieldOfStudy::get();
    }

    public function createSubject(Request $request, $fieldId)
    {
        // return $request;
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);

        $field = FieldOfStudy::findOrFail($fieldId);

        $subject = $field->subjects()->create([
            'field_of_study_id' => $field->id,
            'study_field_name' => $field->name,
            'subject_name' => $request->subject_name,
        ]);

        return response()->json([
            'message' => 'Subject created successfully.',
            'data' => $subject,
        ], 201);
    }
    public function getSubjectsByField($fieldId)
    {
        $field = FieldOfStudy::findOrFail($fieldId);

        $subjects = $field->subjects()->get();

        return response()->json([
            'field' => $field->name,
            'subjects' => $subjects,
        ]);
    }

    public function editSubject($id)
    {
        return  $subject = FieldOFSubject::findOrFail($id);

        return response()->json($subject);
    }
    public function updateSubject(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);

        $subject = FieldOFSubject::findOrFail($id);
        $subject->update([
            'subject_name' => $request->subject_name,
        ]);

        return response()->json([
            'message' => 'Subject updated successfully.',
            'data' => $subject,
        ]);
    }

    public function deleteSubject($id)
    {
        $subject = FieldOFSubject::findOrFail($id);
        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted successfully.'
        ]);
    }

    public function allsubjects()
    {
        $allsubjects = FieldOFSubject::all();

        return response()->json($allsubjects);
    }

    public function alldestinationfilter()
    {
        $destinations = Destination::with('universities')->get();

        return response()->json($destinations);
    }
    public function destinationfilter($destination_id)
    {
        $destination = Destination::with('universities.programs')
            ->findOrFail($destination_id);

        return response()->json([
            'data' => $destination
        ]);
    }
    public function alluniversityfilter()
    {
        return  $alluniversity = University::with('programs')->get();
    }

    public function programsfilter($university_id)
    {
        $university = University::with('programs')->findOrFail($university_id);

        return response()->json($university);
    }

    public function allprogramlevelfilter()
    {
        $allprogramlavel = ProgramLevel::with('programs')->get();
        return response()->json($allprogramlavel);
    }

    public function programlevelfilter($program_level_id)
    {
        $university = ProgramLevel::with('programs')->findOrFail($program_level_id);

        return response()->json($university);
    }

    public function allstudyfieldfilter()
    {

        $allstudyfields = FieldOfStudy::with('universityPrograms')->get();

        return response()->json($allstudyfields);
    }

    public function studyfieldfilter($field_of_study_id)
    {
        $studyfield = FieldOfStudy::with('universityPrograms')->findOrFail($field_of_study_id);
        return response()->json($studyfield);
    }

    public function allintakesfilter()
    {

        $allintakes = Intake::with('universityPrograms')->get();

        return response()->json($allintakes);
    }

    public function intakesfilter($intake_id)
    {
        $allintake = Intake::with('universityPrograms')->findOrFail($intake_id);
        return response()->json($allintake);
    }

    public function allintakemonthfilter()
    {
        $allintakes = IntakeMonth::get();

        return response()->json($allintakes);
    }

    public function intakemonthfilter($month_id)
    {
        // Get all programs
        $programs = UniversityProgram::all();

        // Filter programs that have this intake_month id
        $filteredPrograms = $programs->filter(function ($program) use ($month_id) {
            $intakeMonths = is_string($program->intake_months)
                ? json_decode($program->intake_months, true)
                : $program->intake_months;

            return collect($intakeMonths)->contains('id', $month_id);
        });

        // Add only the matching intake month to each program
        $result = $filteredPrograms->map(function ($program) use ($month_id) {
            $intakeMonths = is_string($program->intake_months)
                ? json_decode($program->intake_months, true)
                : $program->intake_months;

            $matchingMonth = collect($intakeMonths)->firstWhere('id', $month_id);

            // Include full program data + matching intake_month
            $programData = $program->toArray();
            $programData['intake_month'] = $matchingMonth;

            return $programData;
        })->values();

        return response()->json($result);
    }

    public function allprogramtagfilter()
    {
        $allprogramtag = ProgramTag::get();

        return response()->json($allprogramtag);
    }
    public function programtagfilter($program_tag_id)
    {
        $allintake = ProgramTag::with('universityPrograms')->findOrFail($program_tag_id);
        return response()->json($allintake);
    }
    public function matchPrograms(Request $request)
    {
        $query = UniversityProgram::query();

        // Filter by program_name
        if ($request->filled('program_name')) {
            $query->where('program_name', $request->program_name);
        }

        if ($request->filled('program_level')) {
            $query->where('program_level', $request->program_level);
        }

        if ($request->filled('study_permit_or_visa')) {
            $query->where('study_permit_or_visa', $request->study_permit_or_visa);
        }

        if ($request->filled('nationality')) {
            $query->where('nationality', $request->nationality);
        }

        if ($request->filled('education_country')) {
            $query->where('education_country', $request->education_country);
        }

        if ($request->filled('last_level_of_study')) {
            $query->where('last_level_of_study', $request->last_level_of_study);
        }

        if ($request->filled('grading_scheme')) {
            $query->where('grading_scheme', $request->grading_scheme);
        }

        if ($request->filled('ielts_overall')) {
            $ieltsValue = (float) $request->ielts_overall;
            // Match programs that require <= the applicant's IELTS
            $query->where('ielts_overall', '<=', $ieltsValue);
        }

        $programs = $query->get();

        if ($programs->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No programs found.',
                'count' => 0,
                'data' => []
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Programs found.',
            'count' => $programs->count(),
            'data' => $programs
        ]);
    }

    public function allFilters(Request $request)
    {
        $destination = Destination::query();

        // Destination filter (only if submitted)
        $destination->when($request->filled('destination_id'), function ($q) use ($request) {
            $q->where('id', $request->destination_id);
        });

        // University filter (only if submitted)
        $destination->when($request->filled('university_id'), function ($q) use ($request) {
            $q->whereHas('universities', function ($uq) use ($request) {
                $uq->where('id', $request->university_id);
            });
        });

        // Program related filters (only if submitted)
        $destination->when(
            $request->filled('program_level_id')
                || $request->filled('field_of_study_id')
                || $request->filled('intake_id')
                || $request->filled('program_tag_id'),
            function ($q) use ($request) {

                $q->whereHas('universities.programs', function ($pq) use ($request) {

                    $pq->when($request->filled('program_level_id'), function ($x) use ($request) {
                        $x->where('program_level_id', $request->program_level_id);
                    });

                    $pq->when($request->filled('field_of_study_id'), function ($x) use ($request) {
                        $x->where('field_of_study_id', $request->field_of_study_id);
                    });

                    $pq->when($request->filled('intake_id'), function ($x) use ($request) {
                        $x->where('intake_id', $request->intake_id);
                    });

                    $pq->when($request->filled('program_tag_id'), function ($x) use ($request) {
                        $x->where('program_tag_id', $request->program_tag_id);
                    });
                });
            }
        );

        // Eager loading with same condition (avoid empty data)
        $destination->with(['universities.programs' => function ($query) use ($request) {

            $query->when($request->filled('program_level_id'), function ($q) use ($request) {
                $q->where('program_level_id', $request->program_level_id);
            });

            $query->when($request->filled('field_of_study_id'), function ($q) use ($request) {
                $q->where('field_of_study_id', $request->field_of_study_id);
            });

            $query->when($request->filled('intake_id'), function ($q) use ($request) {
                $q->where('intake_id', $request->intake_id);
            });

            $query->when($request->filled('program_tag_id'), function ($q) use ($request) {
                $q->where('program_tag_id', $request->program_tag_id);
            });
        }]);

        return response()->json([
            'status' => true,
            'data' => $destination->get()
        ]);
    }
   public function search(Request $request)
{
    $search = $request->input('search', '');

    if (empty(trim($search))) {
        return response()->json([
            'status' => 'Empty_Search',
            'message' => 'Please provide a search term'
        ], 400);
    }

    $destinations = Destination::query()
        ->where(function ($query) use ($search) {
            $query->where('destinations_name', 'LIKE', "%{$search}%")
                ->orWhere('created_at', 'LIKE', "%{$search}%")
                ->orWhere('updated_at', 'LIKE', "%{$search}%");
        })
        ->orWhereHas('universities', function ($universityQuery) use ($search) {
            $universityQuery->where(function ($uq) use ($search) {
                $uq->where('university_name', 'LIKE', "%{$search}%")
                    ->orWhere('university_desc', 'LIKE', "%{$search}%")
                    ->orWhere('address', 'LIKE', "%{$search}%")
                    ->orWhere('location', 'LIKE', "%{$search}%")
                    ->orWhere('destinations', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%")
                    ->orWhere('founded', 'LIKE', "%{$search}%")
                    ->orWhere('school_id', 'LIKE', "%{$search}%")
                    ->orWhere('institution_type', 'LIKE', "%{$search}%")
                    ->orWhere('dli_number', 'LIKE', "%{$search}%")
                    ->orWhere('application_fee', 'LIKE', "%{$search}%")
                    ->orWhere('application_short_desc', 'LIKE', "%{$search}%")
                    ->orWhere('average_graduate_program', 'LIKE', "%{$search}%")
                    ->orWhere('average_graduate_program_short_desc', 'LIKE', "%{$search}%")
                    ->orWhere('average_undergraduate_program', 'LIKE', "%{$search}%")
                    ->orWhere('average_undergraduate_program_short_desc', 'LIKE', "%{$search}%")
                    ->orWhere('cost_of_living', 'LIKE', "%{$search}%")
                    ->orWhere('cost_of_living_short_desc', 'LIKE', "%{$search}%")
                    ->orWhere('average_gross_tuition', 'LIKE', "%{$search}%")
                    ->orWhere('average_gross_tuition_short_desc', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->orWhere('updated_at', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('programs', function ($programQuery) use ($search) {
                $programQuery->where(function ($pq) use ($search) {
                    $pq->where('program_name', 'LIKE', "%{$search}%")
                        ->orWhere('program_description', 'LIKE', "%{$search}%")
                        ->orWhere('program_level', 'LIKE', "%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%")
                        ->orWhere('location', 'LIKE', "%{$search}%")
                        ->orWhere('phone_number', 'LIKE', "%{$search}%")
                        ->orWhere('university_name', 'LIKE', "%{$search}%")
                        ->orWhere('application_fee', 'LIKE', "%{$search}%")
                        ->orWhere('application_short_desc', 'LIKE', "%{$search}%")
                        ->orWhere('average_graduate_program', 'LIKE', "%{$search}%")
                        ->orWhere('average_graduate_program_short_desc', 'LIKE', "%{$search}%")
                        ->orWhere('average_undergraduate_program', 'LIKE', "%{$search}%")
                        ->orWhere('average_undergraduate_program_short_desc', 'LIKE', "%{$search}%")
                        ->orWhere('cost_of_living', 'LIKE', "%{$search}%")
                        ->orWhere('cost_of_living_short_desc', 'LIKE', "%{$search}%")
                        ->orWhere('average_gross_tuition', 'LIKE', "%{$search}%")
                        ->orWhere('average_gross_tuition_short_desc', 'LIKE', "%{$search}%")
                        ->orWhere('campus_city', 'LIKE', "%{$search}%")
                        ->orWhere('duration', 'LIKE', "%{$search}%")
                        ->orWhere('success_chance', 'LIKE', "%{$search}%")
                        ->orWhere('program_summary', 'LIKE', "%{$search}%")
                        ->orWhere('no_exam_status', 'LIKE', "%{$search}%")
                        ->orWhere('created_at', 'LIKE', "%{$search}%")
                        ->orWhere('updated_at', 'LIKE', "%{$search}%");
                });
            });
        })
        ->with(['universities.programs'])
        ->get();

    if ($destinations->isEmpty()) {
        return response()->json([
            'status' => 'Nothing_Found',
            'message' => 'No data found for your search'
        ]);
    }

    return response()->json([
        'status' => 'Success',
        'data' => $destinations
    ]);
}




    // public function matchPrograms(Request $request)
    // {
    //     $query = UniversityProgram::query();

    //     if ($request->filled('program_name')) {
    //         $query->where('program_name', 'LIKE', '%' . $request->program_name . '%');
    //     }

    //     if ($request->filled('program_level')) {
    //         $query->where('program_level', 'LIKE', '%' . $request->program_level . '%');
    //     }

    //     if ($request->filled('study_permit_or_visa')) {
    //         $query->where('study_permit_or_visa', 'LIKE', '%' . $request->study_permit_or_visa . '%');
    //     }

    //     if ($request->filled('nationality')) {
    //         $query->where('nationality', 'LIKE', '%' . $request->nationality . '%');
    //     }

    //     if ($request->filled('education_country')) {
    //         $query->where('education_country', 'LIKE', '%' . $request->education_country . '%');
    //     }

    //     if ($request->filled('last_level_of_study')) {
    //         $query->where('last_level_of_study', 'LIKE', '%' . $request->last_level_of_study . '%');
    //     }

    //     if ($request->filled('grading_scheme')) {
    //         $query->where('grading_scheme', 'LIKE', '%' . $request->grading_scheme . '%');
    //     }

    //     if ($request->filled('ielts_overall')) {
    //         $query->where('ielts_overall', '>=', $request->ielts_overall);
    //     }

    //     if ($request->filled('ielts_reading')) {
    //         $query->where('ielts_reading', '>=', $request->ielts_reading);
    //     }

    //     if ($request->filled('ielts_writing')) {
    //         $query->where('ielts_writing', '>=', $request->ielts_writing);
    //     }

    //     if ($request->filled('ielts_listening')) {
    //         $query->where('ielts_listening', '>=', $request->ielts_listening);
    //     }

    //     if ($request->filled('ielts_speaking')) {
    //         $query->where('ielts_speaking', '>=', $request->ielts_speaking);
    //     }

    //     if ($request->filled('toefl_overall')) {
    //         $query->where('toefl_overall', '>=', $request->toefl_overall);
    //     }

    //     if ($request->filled('toefl_reading')) {
    //         $query->where('toefl_reading', '>=', $request->toefl_reading);
    //     }

    //     if ($request->filled('toefl_writing')) {
    //         $query->where('toefl_writing', '>=', $request->toefl_writing);
    //     }

    //     if ($request->filled('toefl_listening')) {
    //         $query->where('toefl_listening', '>=', $request->toefl_listening);
    //     }

    //     if ($request->filled('toefl_speaking')) {
    //         $query->where('toefl_speaking', '>=', $request->toefl_speaking);
    //     }

    //     if ($request->filled('pte_overall')) {
    //         $query->where('pte_overall', '>=', $request->pte_overall);
    //     }

    //     if ($request->filled('pte_reading')) {
    //         $query->where('pte_reading', '>=', $request->pte_reading);
    //     }

    //     if ($request->filled('pte_writing')) {
    //         $query->where('pte_writing', '>=', $request->pte_writing);
    //     }

    //     if ($request->filled('pte_listening')) {
    //         $query->where('pte_listening', '>=', $request->pte_listening);
    //     }

    //     if ($request->filled('pte_speaking')) {
    //         $query->where('pte_speaking', '>=', $request->pte_speaking);
    //     }

    //     if ($request->filled('duolingo_total')) {
    //         $query->where('duolingo_total', '>=', $request->duolingo_total);
    //     }

    //     if ($request->filled('field_of_study_name')) {
    //         $query->where('field_of_study_name', 'LIKE', '%' . $request->field_of_study_name . '%');
    //     }

    //     if ($request->filled('program_tag_name')) {
    //         $query->where('program_tag_name', 'LIKE', '%' . $request->program_tag_name . '%');
    //     }

    //     if ($request->filled('university_name')) {
    //         $query->where('university_name', 'LIKE', '%' . $request->university_name . '%');
    //     }

    //     $programs = $query->get();

    //     if ($programs->isEmpty()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No programs found.',
    //             'count' => 0,
    //             'data' => []
    //         ]);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Programs found.',
    //         'count' => $programs->count(),
    //         'data' => $programs
    //     ]);
    // }

}
