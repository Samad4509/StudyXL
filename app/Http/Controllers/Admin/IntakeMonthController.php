<?php

namespace App\Http\Controllers\Admin;

use App\Models\Intake;
use App\Models\IntakeMonth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntakeMonthController extends Controller
{
    public function AllIntakesMonth()
    {
          return  $allintakes = IntakeMonth::get();
    }
    public function CreateIntakeMonth(Request $request, $intakeid)
    {

        $validated = $request->validate([
            'month' => 'required|string',
            'open_date' => 'required|string',
            'submission_deadline' => 'required|string',
        ]);


        $intake = Intake::findOrFail($intakeid);


        $intakeMonth = IntakeMonth::create([
            'intake_id' => $intake->id,
            'month' => $validated['month'],
            'open_date' => $validated['open_date'],
            'submission_deadline' => $validated['submission_deadline'],
        ]);


        return response()->json([
            'message' => 'Intake month created successfully',
            'data' => $intakeMonth,
        ], 201);
    }
    public function EditIntakeMonth($id)
    {
        $intakeMonth = IntakeMonth::findOrFail($id);

        return response()->json([
            'data' => $intakeMonth
        ]);
    }

    public function UpdateIntakeMonth(Request $request, $id)
    {
        $validated = $request->validate([
            'month' => 'required|string',
            'open_date' => 'required|string',
            'submission_deadline' => 'required|string',
        ]);

        $intakeMonth = IntakeMonth::findOrFail($id);

        $intakeMonth->update($validated);

        return response()->json([
            'message' => 'Intake month updated successfully',
            'data' => $intakeMonth,
        ]);
    }
    public function DeleteIntakeMonth($id)
    {
        $intakeMonth = IntakeMonth::findOrFail($id);

        $intakeMonth->delete();

        return response()->json([
            'message' => 'Intake month deleted successfully'
        ]);
    }
}
