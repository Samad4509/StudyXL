<?php

namespace App\Http\Controllers\Admin;

use App\Models\IntakeMonth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IntakeMonthController extends Controller
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
            'intake_id' => 'required|exists:intakes,id',
            'month' => 'required|string'
        ]);

      $month = IntakeMonth::create($request->only('intake_id', 'month'));

        return response()->json([
            'success' => true,
            'message' => 'Month added successfully.',
            'data' => $month
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
