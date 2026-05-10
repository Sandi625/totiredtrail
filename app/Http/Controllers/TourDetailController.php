<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourDetailController extends Controller
{
    /**
     * Menampilkan halaman detail tour.
     */
   public function show($slug)
{
    // Ambil tour berdasarkan slug beserta relasi days
    $tour = Tour::with('days')->where('slug', $slug)->firstOrFail();

    // Ambil tour lain yang aktif & bukan yang ini
    $otherTours = Tour::where('id', '!=', $tour->id)
                      ->where('status', 1)
                      ->get();

    // Kirim ke view detail
    return view('user.tour.detail', compact('tour', 'otherTours'));
}

}
