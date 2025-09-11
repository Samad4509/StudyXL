<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = ProgramTag::all();

        return response()->json([
            'data' => $tags
        ]);
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
            'program_tag' => 'required|string|max:255',
        ]);

        $tag = ProgramTag::create($validated);

        return response()->json([
            'message' => 'Program tag created successfully.',
            'data' => $tag
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
        $tag = ProgramTag::findOrFail($id);

        return response()->json([
            'data' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validated = $request->validate([
            'program_tag' => 'required|string|max:255',
        ]);

        $tag = ProgramTag::findOrFail($id);
        $tag->update($validated);

        return response()->json([
            'message' => 'Program tag updated successfully.',
            'data' => $tag
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = ProgramTag::findOrFail($id);
        $tag->delete();

        return response()->json([
            'message' => 'Program tag deleted successfully.'
        ]);
    }
}
