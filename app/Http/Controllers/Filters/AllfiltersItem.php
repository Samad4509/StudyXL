<?php

namespace App\Http\Controllers\Filters;

use App\Models\ProgramLevel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FieldOfStudy;
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
}
