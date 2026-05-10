<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
   public function index()
{
    $reviews = Review::latest()->paginate(5);
    return view('admin.review.index', compact('reviews'));
}


    public function create()
    {
        return view('admin.review.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name'        => 'required|string|max:100',
        'email'       => 'nullable|email|max:100',
        'review_text' => 'required|string',
        'rating'      => 'required|integer|min:1|max:5',
        'photo.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', // multiple
        'status'      => 'nullable|boolean',
    ]);

    $photoNames = [];

    // Upload multiple photos
    if ($request->hasFile('photo')) {
        foreach ($request->file('photo') as $photo) {
            $filename = time() . '_' . uniqid() . '.' . $photo->extension();
            $photo->move(public_path('uploads/reviews'), $filename);
            $photoNames[] = $filename;
        }
    }

    Review::create([
        'name'        => $request->name,
        'email'       => $request->email,
        'review_text' => $request->review_text,
        'rating'      => $request->rating,
        'photo'       => count($photoNames) ? json_encode($photoNames) : null, // simpan sebagai JSON
        'status'      => $request->status ?? 1,
    ]);

    return redirect()->route('review.index')->with('success', 'Review berhasil ditambahkan!');
}



    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

public function update(Request $request, $id)
{
    $review = Review::findOrFail($id);

    $request->validate([
        'name'        => 'required|string|max:100',
        'email'       => 'nullable|email|max:100',
        'review_text' => 'required|string',
        'rating'      => 'required|integer|min:1|max:5',
        'photo.*'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        'status'      => 'nullable|boolean',
    ]);

    // Default: pakai foto lama
    $photoNames = json_decode($review->photo, true) ?? [];

    // JIKA ADA FOTO BARU → hapus lama & upload baru
    if ($request->hasFile('photo')) {

        // hapus foto lama
        foreach ($photoNames as $old) {
            $oldPath = public_path('uploads/reviews/' . $old);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // upload foto baru
        $photoNames = [];
        foreach ($request->file('photo') as $photo) {
            $filename = time() . '_' . uniqid() . '.' . $photo->extension();
            $photo->move(public_path('uploads/reviews'), $filename);
            $photoNames[] = $filename;
        }
    }

    $review->update([
        'name'        => $request->name,
        'email'       => $request->email,
        'review_text' => $request->review_text,
        'rating'      => $request->rating,
        'photo'       => count($photoNames) ? json_encode($photoNames) : $review->photo,
        'status'      => $request->status ?? $review->status,
    ]);

    return redirect()->route('review.index')
        ->with('success', 'Review berhasil diperbarui!');
}




  public function destroy($id)
{
    $review = Review::findOrFail($id);

    // Hapus semua foto (karena disimpan sebagai JSON array)
    if ($review->photo) {
        $photos = json_decode($review->photo, true);

        foreach ($photos as $photo) {
            $path = public_path('uploads/reviews/' . $photo);
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    $review->delete();

    return redirect()->route('review.index')
        ->with('success', 'Review berhasil dihapus!');
}
}
