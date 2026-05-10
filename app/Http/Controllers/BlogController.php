<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogDay;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
  public function index()
{
    $blogs = Blog::with('days')->latest()->paginate(5);
    return view('admin.blog.index', compact('blogs'));
}

    public function show($id)
{
    $blog = Blog::with('days')->findOrFail($id);
    return view('admin.blog.show', compact('blog'));
}


    public function create()
    {
        return view('admin.blog.create');
    }

public function store(Request $request)
{
    // ================= VALIDASI =================
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required',
        'route_name' => 'nullable|string',
        'status' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        // Itinerary / Days
        'days.*.title' => 'nullable|string|max:255',
        'days.*.description' => 'nullable',
        'days.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'days.*.image_title' => 'nullable|string|max:255',
        'days.*.image_description' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // ================= UPLOAD GAMBAR UTAMA =================
    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/blogs'), $imageName);
    }

    // ================= INSERT BLOG =================
    $blog = Blog::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'route_name' => $request->route_name,
        'image' => $imageName,
        'status' => $request->status ?? 1,
    ]);

    // ================= INSERT BLOG DAYS =================
    if ($request->days) {
        foreach ($request->days as $day) {

            // Abaikan day kosong (tidak ada title, desc, image)
            if (
                empty($day['title']) &&
                empty($day['description']) &&
                empty($day['image'])
            ) {
                continue;
            }

            // Upload image untuk day jika ada
            $dayImage = null;
            if (isset($day['image']) && $day['image']) {
                $dayImage = time() . '_' . uniqid() . '.' . $day['image']->extension();
                $day['image']->move(public_path('uploads/blog_days'), $dayImage);
            }

            BlogDay::create([
                'blog_id' => $blog->id,
                'title' => $day['title'],
                'description' => $day['description'],
                'image' => $dayImage,
                'image_title' => $day['image_title'] ?? null,
                'image_description' => $day['image_description'] ?? null,
            ]);
        }
    }

    return response()->json([
        'success' => 'Blog berhasil dibuat!'
    ]);
}


    public function edit($id)
    {
        $blog = Blog::with('days')->findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

public function update(Request $request, $id)
{
    try{
    $blog = Blog::with('days')->findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'route_name' => 'nullable|string',
        'status' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
        'days.*.id' => 'nullable|exists:blog_days,id',
        'days.*.title' => 'required|string|max:255',
        'days.*.description' => 'required',
        'days.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:102400',
        'days.*.image_title' => 'nullable|string|max:255',
        'days.*.image_description' => 'nullable|string',
    ]);

    // Update main blog image
    $imageName = $blog->image;
    if ($request->hasFile('image')) {
        if ($blog->image && file_exists(public_path('uploads/blogs/' . $blog->image))) {
            unlink(public_path('uploads/blogs/' . $blog->image));
        }
        $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/blogs'), $imageName);
    }

    // Update blog
    $blog->update([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
        'description' => $request->description,
        'route_name' => $request->route_name,
        'image' => $imageName,
        'status' => $request->status ?? 1,
    ]);

    // Hapus day yang dihapus di form
    $existingDayIds = $blog->days->pluck('id')->toArray();
    $updatedDayIds = collect($request->days)->pluck('id')->filter()->toArray();
    $daysToDelete = array_diff($existingDayIds, $updatedDayIds);
    if (!empty($daysToDelete)) {
        foreach ($daysToDelete as $delId) {
            $day = BlogDay::find($delId);
            if ($day && $day->image && file_exists(public_path('uploads/blog_days/' . $day->image))) {
                unlink(public_path('uploads/blog_days/' . $day->image));
            }
            BlogDay::destroy($delId);
        }
    }

    // Update atau create day
    if ($request->days) {
        foreach ($request->days as $day) {
            $dayImage = null;
            if (isset($day['id'])) {
                // update existing day
                $blogDay = BlogDay::find($day['id']);
                $dayImage = $blogDay->image;

                if (isset($day['image']) && $day['image']) {
                    if ($dayImage && file_exists(public_path('uploads/blog_days/' . $dayImage))) {
                        unlink(public_path('uploads/blog_days/' . $dayImage));
                    }
                    $dayImage = time() . '_' . uniqid() . '.' . $day['image']->extension();
                    $day['image']->move(public_path('uploads/blog_days'), $dayImage);
                }

                $blogDay->update([
                    'title' => $day['title'],
                    'description' => $day['description'],
                    'image' => $dayImage,
                    'image_title' => $day['image_title'] ?? null,
                    'image_description' => $day['image_description'] ?? null,
                ]);

            } else {
                // create new day
                if (isset($day['image']) && $day['image']) {
                    $dayImage = time() . '_' . uniqid() . '.' . $day['image']->extension();
                    $day['image']->move(public_path('uploads/blog_days'), $dayImage);
                }

                BlogDay::create([
                    'blog_id' => $blog->id,
                    'title' => $day['title'],
                    'description' => $day['description'],
                    'image' => $dayImage,
                    'image_title' => $day['image_title'] ?? null,
                    'image_description' => $day['image_description'] ?? null,
                ]);
            }
        }
    }

   // =============================
        // Redirect sukses dengan SweetAlert
        // =============================
return redirect()->route('blogs.index')->with('success', 'Blog berhasil diperbarui!');


    } catch (\Exception $e) {
        // =============================
        // Redirect gagal dengan SweetAlert
        // =============================
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui blog: ' . $e->getMessage());
    }

}



    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->image && file_exists(public_path('uploads/blogs/'.$blog->image))) {
            unlink(public_path('uploads/blogs/'.$blog->image));
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog berhasil dihapus!');
    }
}
