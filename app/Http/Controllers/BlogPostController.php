<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    // Show all blog posts in blog-homepage
    public function index()
    {
        // OLD $posts = BlogPost::all();
        $posts = BlogPost::with('user', 'comments')->get();
        return view('blog.index', compact('posts'));
    }

    // Redirect to page to create new blog post
    public function create()
    {
        return view('blog.create');
    }

    // Store created blog post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        // Associate the authenticated user with the blog post
        $post = auth()->user()->blogPosts()->create($request->all());

        return redirect()->route('blog.index');
    }

    // Edit blog post
    public function edit(BlogPost $blogPost)
    {
        // Check if the authenticated user owns the blog post
        if (auth()->user()->id !== $blogPost->user_id) {
            abort(403); // Forbidden
        }

        return view('blog.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        // Check if the authenticated user owns the blog post
        if (auth()->user()->id !== $blogPost->user_id) {
            abort(403); // Forbidden
        }

        $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);

        $blogPost->update($request->all());

        return redirect()->route('blog.index');
    }

    public function destroy(BlogPost $blogPost)
    {
        // Check if the authenticated user owns the blog post
        if (auth()->user()->id !== $blogPost->user_id) {
            abort(403); // Forbidden
        }

        $blogPost->delete();

        return redirect()->route('blog.index');
    }
}
