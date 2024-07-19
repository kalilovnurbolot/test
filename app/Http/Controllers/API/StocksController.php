<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StocksController extends Controller
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
        $validate=$request->validate([
            'product_id'=>'required',
            'count'=>'required',
            'address'=>'required',
            ]);
        $stock=new \App\Models\Stock();
        $stock->product_id=$request->product_id;
        $stock->count=$request->count;
        $stock->address=$request->address;
        $stock->save();
        return response()->json([
            'status'=>true,
            'stock'=>$stock,
            'message'=>'Stock added successfully'
        ],200);
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
