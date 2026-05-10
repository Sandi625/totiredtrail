<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tour;
use App\Models\Blog;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'categoryCount' => Category::count(),
            'tourCount'     => Tour::count(),
            'blogCount'     => Blog::count(),
            'reviewCount'   => Review::count(),
        ];

        return view('dashboard.index', $data);
    }
}
