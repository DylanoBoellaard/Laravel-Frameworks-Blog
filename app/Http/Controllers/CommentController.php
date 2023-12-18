<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\BlogPost;

class CommentController extends Controller
{
    public function store(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'content' => 'required',
        ]);

        // Associate the authenticated user with the comment
        $comment = auth()->user()->comments()->create([
            'content' => $request->input('content'),
            'blog_post_id' => $blogPost->id,
        ]);

        return redirect()->back();
    }
}
