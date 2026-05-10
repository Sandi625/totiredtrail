<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    // Menampilkan semua blog untuk User
    public function index()
    {
        $blogs = Blog::latest()->paginate(50);
        return view('user.blog.index', compact('blogs'));
    }

    // Menampilkan blog detail berdasarkan slug
    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('user.blog.show', compact('blog'));
    }
}
