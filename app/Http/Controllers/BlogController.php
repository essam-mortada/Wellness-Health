<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\NewsBar;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = blog::paginate(5);

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);


        $blog = new blog();
        $blog->title = strip_tags($request->title);
        $blog->summary = strip_tags($request->summary);
        $blog->content = strip_tags($request->content);
        if ($request->hasFile('image')) {
            $imageName = time() . rand(0, 500) . '.' . $request->image->extension();
            $request->image->move(public_path('blogs_uploads'), $imageName);
            $blog->image = $imageName;
        } else {
            $blog->image = 'default.png';
        }
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'blog created successfully.');
    }

    public function show(blog $blog)
    {
        $newsBar = NewsBar::first();
        $recentBlogs = blog::orderBy('created_at', 'desc')->paginate(3);
        return view('single-blog', compact('blog', 'recentBlogs','newsBar'));
    }

    public function showBlogAdmin(blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, blog $blog)
    {
        $request->validate([
            'title' => 'required|string',
            'summary' => 'required|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            if ($blog->image != 'default.png') {
                unlink(public_path('blogs_uploads/' . $blog->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blogs_uploads'), $imageName);
            $blog->image = $imageName;
        }
        $blog->title = strip_tags($request->title);
        $blog->summary = strip_tags($request->summary);
        $blog->content = strip_tags($request->content);
        $blog->save();
        return redirect()->route('blogs.index')->with('success', 'blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(blog $blog)
    {

        if ($blog->image != 'default.png') {
            unlink(public_path('blogs_uploads/' . $blog->image));
        }
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'blog deleted successfully.');
    }
}
