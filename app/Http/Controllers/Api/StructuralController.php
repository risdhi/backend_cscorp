<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Structural;

class StructuralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $structural = \App\Models\Structural::all();
        return response()->json($structural);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $structural = Structural::find($id);
        if (!$structural) {
            return response()->json(['message' => 'Structural not found'], 404);
        }
        return response()->json($structural);
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
