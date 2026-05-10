<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $gallery = Gallery::latest()->paginate(5);
    return view('admin.gallery.index', compact('gallery'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $request->validate([
        'judul'        => 'nullable|string|max:255',
        'deskripsi'    => 'nullable|string',
        'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // video lokal
        'video_local'  => 'nullable|mimes:mp4,mov,avi,mkv|max:30720',

        // video youtube
        'video_yt'     => 'nullable|string',

        'status'       => 'nullable|boolean',
    ]);

    // Ambil field dasar
    $data = $request->only(['judul', 'deskripsi', 'status']);

    /* ---------------------------
        Upload Gambar
    ----------------------------*/
    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('gallery/gambar', 'public');
    }

    /* ---------------------------
        Upload Video Lokal
    ----------------------------*/
    if ($request->hasFile('video_local')) {
        $data['video_local'] = $request->file('video_local')->store('gallery/video', 'public');
    }

    /* ---------------------------
        Video YouTube
    ----------------------------*/
    if ($request->video_yt) {
        $data['video_yt'] = $request->video_yt;
    }

    Gallery::create($data);

    return redirect()
        ->route('gallery.index')
        ->with('success', 'Gallery berhasil ditambahkan!');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $request->validate([
        'judul'        => 'nullable|string|max:255',
        'deskripsi'    => 'nullable|string',
        'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // video lokal
        'video_local'  => 'nullable|mimes:mp4,mov,avi,mkv|max:30720',

        // youtube
        'video_yt'     => 'nullable|string',

        'status'       => 'nullable|boolean',
    ]);

    $gallery = Gallery::findOrFail($id);

    $data = $request->only(['judul', 'deskripsi', 'status']);

    /* -----------------------------
        Update Gambar
    ------------------------------*/
    if ($request->hasFile('gambar')) {

        // hapus file lama
        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        // simpan baru
        $data['gambar'] = $request->file('gambar')->store('gallery/gambar', 'public');
    }

    /* -----------------------------
        Update Video Lokal
    ------------------------------*/
    if ($request->hasFile('video_local')) {

        // hapus video lama
        if ($gallery->video_local && Storage::disk('public')->exists($gallery->video_local)) {
            Storage::disk('public')->delete($gallery->video_local);
        }

        // simpan video baru
        $data['video_local'] = $request->file('video_local')->store('gallery/video', 'public');
    }

    /* -----------------------------
        Update YouTube URL
    ------------------------------*/
    if ($request->video_yt) {
        $data['video_yt'] = $request->video_yt;
    }

    $gallery->update($data);

    return redirect()
        ->route('gallery.index')
        ->with('success', 'Gallery berhasil diperbarui!');
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $gallery = Gallery::findOrFail($id);

    // Hapus gambar
    if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
        Storage::disk('public')->delete($gallery->gambar);
    }

    // Hapus video lokal
    if ($gallery->video_local && Storage::disk('public')->exists($gallery->video_local)) {
        Storage::disk('public')->delete($gallery->video_local);
    }

    $gallery->delete();

    return redirect()->route('gallery.index')->with('success', 'Gallery berhasil dihapus!');
}

}
