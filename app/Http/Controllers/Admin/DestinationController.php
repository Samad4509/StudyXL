<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
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
        $validated = $request->validate([
            'description_name' => 'required|string|max:255',
        ]);

        $destination = Destination::create([
            'description_name' => $validated['description_name'],
        ]);

        return response()->json([
            'message' => 'Destination created successfully.',
            'data' => $destination
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
        $destination = Destination::findOrFail($id);

    return response()->json([
        'data' => $destination
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'description_name' => 'required|string|max:255',
        ]);

        $destination = Destination::findOrFail($id);
        $destination->update([
            'description_name' => $validated['description_name'],
        ]);

        return response()->json([
            'message' => 'Destination updated successfully.',
            'data' => $destination
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destination = Destination::findOrFail($id);
        $destination->delete();

        return response()->json([
            'message' => 'Destination deleted successfully.'
        ]);
    }

}
