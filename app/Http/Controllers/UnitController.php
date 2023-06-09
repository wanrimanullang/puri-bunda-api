<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $units = Unit::paginate(10);

        return response()->json(['data' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:units',
        ]);

        $unit = new Unit();
        $unit->name = $request->input('name');
        $unit->save();

        return response()->json(['message' => 'Unit created successfully', 'data' => $unit], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit, $id)
    {
        $unit = Unit::findOrFail($id);
        return response()->json(['data' => $unit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        try {
            $unit = Unit::findOrFail($id);

            $unit->name = $request->input('name');
            $unit->save();

            return response()->json(['message' => 'Unit updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update unit'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit, $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return response()->json(['message' => 'Unit deleted successfully']);
    }
}
