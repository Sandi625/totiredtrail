<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class UserGalleryController extends Controller
{
    /**
     * Menampilkan semua gallery (gabungan gambar + video)
     */
    // public function index()
    // {
    //     $gallery = Gallery::where('status', 1)
    //         ->orderBy('id', 'desc')
    //         ->get();

    //     return view('user.gallery.index', compact('gallery'));
    // }

    /**
     * Menampilkan halaman khusus GAMBAR
     */
    public function images()
    {
        $images = Gallery::where('status', 1)
            ->whereNotNull('gambar')
            ->orderBy('id', 'desc')
            ->get();

        return view('user.gallery.images', compact('images'));
    }

    /**
     * Menampilkan halaman khusus VIDEO
     */
    public function videos()
    {
        $videos = Gallery::where('status', 1)
            ->where(function ($q) {
                $q->whereNotNull('video_local')
                  ->orWhereNotNull('video_yt');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('user.gallery.videos', compact('videos'));
    }

    /**
     * Detail gallery
     */
    // public function show($id)
    // {
    //     $item = Gallery::where('status', 1)->findOrFail($id);

    //     return view('user.gallery.show', compact('item'));
    // }
}
