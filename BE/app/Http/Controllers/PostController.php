<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = post::all();
        return response()->json($posts, 200);
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
            'body' => 'required'
        ]);
        $post = post::create([
            'name' => $request->name,
            'body' => $request->body,
            'user_id' => $request->user()->id,
            'category_id' => $request->categoryId
        ]);
        return response()->json(['post' => $post, 'messg' => 'post created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post)
    {
        return response()->json($post, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $request->validate([
            'name' => 'required',
            'body' => 'required'
        ]);
        $upost = $post->update([
            'name' => $request->name,
            'body' => $request->body
        ]);
        return response()->json($upost, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return response()->json(['mssg' => 'post deleted'], 200);
    }
}
