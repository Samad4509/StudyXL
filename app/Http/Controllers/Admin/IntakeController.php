<?php

namespace App\Http\Controllers\Admin;

use App\Models\Intake;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string'
        ]);

        $intake = Intake::create($request->only('name'));

        return response()->json([
            'success' => true,
            'message' => 'Intake added successfully.',
            'data' => $intake
        ], 201); // 201 = Created
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $intake = Intake::find($id);

        if (!$intake) {
            return response()->json(['success' => false, 'message' => 'Intake not found.'], 404);
        }

        return response()->json(['success' => true, 'data' => $intake]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $intake = Intake::find($id);

        if (!$intake) {
            return response()->json(['success' => false, 'message' => 'Intake not found.'], 404);
        }

        $request->validate([
            'name' => 'required|string'
        ]);

        $intake->update($request->only('name'));

        return response()->json([
            'success' => true,
            'message' => 'Intake updated successfully.',
            'data' => $intake
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $intake = Intake::find($id);

        if (!$intake) {
            return response()->json([
                'success' => false,
                'message' => 'Intake not found.'
            ], 404);
        }

        $intake->delete();

        return response()->json([
            'success' => true,
            'message' => 'Intake deleted successfully.'
        ]);
    }

}
