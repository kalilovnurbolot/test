<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>'required|string',
            'description'=>'required|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
            if($request->hasfile('image')){
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/category/images');
                $image->move($destinationPath, $name);
                }
           $yes = Category::where('name',$validate['name'])->first();
           if($yes){
            return response()->json(['message'=>'Category already exist']);
            }
        $category=new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->image=$name;
        $category->save();
        return response()->json([
            'status'=>true,
            'message'=>'Category created successfully',
            'category'=>$category,
        ]);
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
