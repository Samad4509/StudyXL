<?php

namespace App\Http\Controllers\Filters;

use App\Models\ProgramLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\FieldOfStudy;
use App\Models\FieldOFSubject;
use App\Models\University;
use Illuminate\Support\Facades\Log;

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

    public function FieldOfstudyedit($id){
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
            'field_of_study_id'=>$field->id,
            'study_field_name'=>$field->name,
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
        $destination = Destination::with('universities')->findOrFail($destination_id);

        return response()->json($destination);
        
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


}
