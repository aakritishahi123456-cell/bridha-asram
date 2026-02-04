<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::with(['categories', 'author'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc');
            
        if ($request->has('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        $posts = $query->paginate(12);
        $categories = BlogCategory::withCount('posts')->get();
        
        return view('blog.index', compact('posts', 'categories'));
    }
    
    public function show(BlogPost $post)
    {
        if ($post->status !== 'published') {
            abort(404);
        }
        
        $post->load(['categories', 'author']);
        $relatedPosts = BlogPost::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->limit(3)
            ->get();
            
        return view('blog.show', compact('post', 'relatedPosts'));
    }
}