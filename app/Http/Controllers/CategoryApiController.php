<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $category = new Category;
        $category->name = request()->name;
        $category->save();
        //return $category;
        return Category::all();
    }

    /**
     * Display the specified resource.
     */

    // public function show(Category $category)
    // {
    //     //
    //     return Category::find($id);
    // }

    public function show(Request $request, string $id)
    {
        // Update the user...
 
        return Category::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    
    //  public function update(Request $request, Category $category)
    // {
    //     //
    //     $category = Category::find($id);
    //     $category->name = request()->name;
    //     $category->save();
    //     return $category;
    // }

    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        $category->name = request()->name;
        $category->update();
        // return $category;  
        return Category::all();     
    }       

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Category $category)
    // {
    //     //
    //     $category = Category::find($id);
    //     $category->delete();
    //     return $category;
    // }

    public function destroy(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        $category->delete();
        return Category::all();
    }
}
