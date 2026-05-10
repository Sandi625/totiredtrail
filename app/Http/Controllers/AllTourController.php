<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class AllTourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();

        return view('blog', compact('tours')); // PENTING!
    }
}
