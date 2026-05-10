<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tour;
use App\Models\Category;
use App\Models\Review; // ⬅ tambahkan ini
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    // Kategori + tours
    $categories = Category::with(['tours' => function($query) use ($search) {

        $query->where('status', 1);

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

    }])->get();

    // ✅ TAMBAHKAN INI
    $tours = Tour::with('category')
                ->where('status', 1)
                ->latest()
                ->get();

    // Blog
    $blogs = Blog::where('status', 1)->latest()->get();

    // Review
    $reviews = Review::where('status', 1)->latest()->get();

    return view('index', compact(
        'categories',
        'search',
        'blogs',
        'reviews',
        'tours' // ✅ WAJIB ADA
    ));
}
}
