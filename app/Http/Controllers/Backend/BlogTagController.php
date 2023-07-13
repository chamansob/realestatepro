<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Blog_tag;
use Illuminate\Http\Request;

class BlogTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Blog_tag::latest()->get();
        return view(
            'backend.post_tag.all_tag',
            compact('tags')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.post_tag.add_tag');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tag_name' => 'required|unique:blog_tags|max:200',
        ]);

        Blog_tag::insert([
            'tag_name' => $request->tag_name,
            'tag_slug' => strtolower(str_replace(' ', '-', $request->tag_name)),
        ]);

        $notification = array(
            'message' => 'Tag Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog_tag $blog_tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog_tag $blog_tag)
    {
        return view('backend.post_tag.edit_tag', compact('blog_tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog_tag $blog_tag)
    {
        $validated = $request->validate([
            'tag_name' => 'required|max:200',
        ]);

        $blog_tag->update([
            'tag_name' => $request->tag_name,
            'tag_slug' => strtolower(str_replace(' ', '-', $request->tag_name)),

        ]);
        $notification = array(
            'message' => 'tag Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog_tag $blog_tag)
    {
        dd($blog_tag);
        $blog_tag->delete();
        $notification = array(
            'message' => 'Tag Deleted successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
