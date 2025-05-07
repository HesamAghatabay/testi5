<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::all();
        return response()->json($category, 200);
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
        $request->validate([
            'name' => 'required',
            'body' => 'required',
        ]);
        $category = category::create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => $request->user()->id,
        ]);
        return response()->json([$category], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $category->update([
            'name' => $request->name,
            'body' => $request->body,
        ]);
        if (!$category) {
            return response()->json(['status' => false], 400);
        }
        return response()->json(['status' => true], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
        return response()->json(['status'=>true],200);
    }
}
