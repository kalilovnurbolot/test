<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CharacteristicsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'value' => 'required',
        ]);
        $ch = new \App\Models\Characteristic();
        $ch->product_id = $request->product_id;
        $ch->name = $request->name;
        $ch->value = $request->value;
        $ch->save();
        return response()->json([
            'status' => true,
            'Characterstics' => $ch,
            'message' => 'Characterstics added successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
