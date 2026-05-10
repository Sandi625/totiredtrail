<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    /**
     * Menampilkan semua review yang aktif untuk user.
     */
    public function index()
    {
        $reviews = Review::where('status', 1)
            ->latest()
            ->get();

        return view('user.reviews.index', compact('reviews'));
    }


    /**
     * Form untuk user membuat review baru
     */
    public function create()
    {
        return view('user.reviews.create');
    }

    /**
     * Simpan review dari user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'email'       => 'nullable|email|max:100',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'photo.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400', // per foto
        ]);

        try {
            $review = new Review();
            $review->name        = $request->name;
            $review->email       = $request->email;
            $review->rating      = $request->rating;
            $review->review_text = $request->review_text;
            $review->status      = 0; // pending

            // Handle multiple photo upload
            $photos = [];
            if ($request->hasFile('photo')) {
                foreach ($request->file('photo') as $file) {
                    $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/reviews'), $filename);
                    $photos[] = $filename;
                }
            }

            // Simpan array filename sebagai JSON di kolom photo
            $review->photo = !empty($photos) ? json_encode($photos) : null;

            $review->save();

            return redirect()->back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit review: ' . $e->getMessage());
        }
    }




    /**
     * Menampilkan detail review tertentu (opsional)
     */
    public function show($id)
    {
        $review = Review::where('status', 1)->findOrFail($id);

        return view('user.reviews.show', compact('review'));
    }
}
