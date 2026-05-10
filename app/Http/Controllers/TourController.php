<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourDay;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $tours = Tour::with('category')->paginate(5);
    return view('admin.tour.index', compact('tours'));
}


    public function show(Tour $tour)
{
    // Load relasi kategori dan days
    $tour->load(['category', 'days']);

    return view('admin.tour.show', compact('tour'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.tour.create', compact('categories'));
    }

 public function store(Request $request)
{
    try {
        // ================= VALIDASI =================
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'route_name'  => 'nullable|string|max:255',
            'images.*'    => 'nullable|mimes:jpg,png,jpeg,webp,heic,heif|max:102400',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',

            // Days
            'days'                     => 'required|array|min:1',
            'days.*.title'             => 'required|string|max:255',
            'days.*.description'       => 'required|string',
            'days.*.image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'days.*.image_title'       => 'nullable|string|max:255',
            'days.*.image_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // ================= UPLOAD TOUR IMAGES =================
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                if ($img->isValid()) {
                    $filename = uniqid() . '-' . time() . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('uploads/tours'), $filename);
                    $imageNames[] = $filename;
                }
            }
        }

        // ================= AUTO ROUTE NAME =================
        $routeName = $request->route_name ?: Str::slug($request->title);

        // ================= CREATE TOUR =================
        $tour = Tour::create([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'route_name'  => $routeName,
            'images'      => $imageNames, // langsung array, model akan casting
            'price'       => $request->price,
            'description' => $request->description ?? null,
            'status'      => $request->status ?? 0,
        ]);

        // ================= CREATE TOUR DAYS =================
        foreach ($request->days as $index => $day) {
            $dayImage = null;

            if (!empty($day['image']) && $day['image']->isValid()) {
                $dayImageName = uniqid() . '-' . time() . '.' . $day['image']->getClientOriginalExtension();
                $day['image']->move(public_path('uploads/tour_days'), $dayImageName);
                $dayImage = $dayImageName;
            }

            $tour->days()->create([
                'title'             => $day['title'],
                'description'       => $day['description'],
                'image'             => $dayImage,
                'image_title'       => $day['image_title'] ?? null,
                'image_description' => $day['image_description'] ?? null,
                'order'             => $index + 1,
            ]);
        }

        return response()->json([
            'message' => 'Tour berhasil dibuat!',
            'data'    => $tour->load('days', 'category') // biar langsung load relasi
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'errors' => ['server' => [$e->getMessage()]]
        ], 500);
    }
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        $categories = Category::all();
        return view('admin.tour.edit', compact('tour', 'categories'));
    }

public function update(Request $request, Tour $tour)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'title'       => 'required|string|max:255',
        'images.*'    => 'nullable|mimes:jpg,png,jpeg,webp,heic,heif|max:102400',
        'price'       => 'required|numeric',
        'status'      => 'nullable|boolean',
        'description' => 'nullable|string',
        'days'                     => 'required|array|min:1',
        'days.*.id'                => 'nullable|exists:tour_days,id',
        'days.*.title'             => 'required|string|max:255',
        'days.*.description'       => 'required|string',
        'days.*.image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'days.*.image_title'       => 'nullable|string|max:255',
        'days.*.image_description' => 'nullable|string',
        'days.*._destroy'          => 'nullable|boolean',
    ]);

    DB::beginTransaction();

    try {
        // ==================== HANDLE TOUR IMAGES ====================
        $imageNames = [];

        if (!empty($tour->images)) {
            // jika json string, decode
            if (is_string($tour->images)) {
                $decoded = json_decode($tour->images, true);
                $imageNames = is_array($decoded) ? $decoded : [$tour->images];
            } elseif (is_array($tour->images)) {
                $imageNames = $tour->images;
            }
        }

        if ($request->hasFile('images')) {
            // Hapus gambar lama
            foreach ($imageNames as $oldImg) {
                $path = public_path('uploads/tours/' . $oldImg);
                if (file_exists($path)) unlink($path);
            }

            // Upload gambar baru
            $imageNames = [];
            foreach ($request->file('images') as $img) {
                $filename = uniqid() . '-' . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('uploads/tours'), $filename);
                $imageNames[] = $filename;
            }
        }

        // ==================== GENERATE SLUG & ROUTE ====================
        $slug = Str::slug($request->title);
        $routeName = "tour." . $slug;

        // ==================== UPDATE TOUR ====================
        $tour->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'route_name'  => $routeName,
            'images'      => json_encode($imageNames), // simpan sebagai JSON
            'price'       => $request->price,
            'description' => $request->description ?? null,
            'status'      => $request->status ? 1 : 0,
        ]);

        // ==================== UPDATE TOUR DAYS ====================
        foreach ($request->days as $index => $day) {
            // HAPUS DAY
            if (!empty($day['_destroy']) && $day['_destroy']) {
                if (!empty($day['id'])) {
                    $oldDay = TourDay::find($day['id']);
                    if ($oldDay && $oldDay->image) {
                        $path = public_path('uploads/tour_days/' . $oldDay->image);
                        if (file_exists($path)) unlink($path);
                    }
                    $oldDay->delete();
                }
                continue;
            }

            // HANDLE IMAGE DAY
            $dayImage = null;
            if (!empty($day['image']) && $day['image']->isValid()) {
                $dayImageName = uniqid() . '-' . time() . '.' . $day['image']->getClientOriginalExtension();
                $day['image']->move(public_path('uploads/tour_days'), $dayImageName);
                $dayImage = $dayImageName;
            }

            // UPDATE EXISTING DAY
            if (!empty($day['id'])) {
                $dayModel = TourDay::find($day['id']);
                $dayModel->update([
                    'title'             => $day['title'],
                    'description'       => $day['description'],
                    'image'             => $dayImage ?? $dayModel->image,
                    'image_title'       => $day['image_title'] ?? $dayModel->image_title,
                    'image_description' => $day['image_description'] ?? $dayModel->image_description,
                    'order'             => $index + 1,
                ]);
            }
            // CREATE NEW DAY
            else {
                $tour->days()->create([
                    'title'             => $day['title'],
                    'description'       => $day['description'],
                    'image'             => $dayImage,
                    'image_title'       => $day['image_title'] ?? null,
                    'image_description' => $day['image_description'] ?? null,
                    'order'             => $index + 1,
                ]);
            }
        }

        DB::commit();

        return redirect()->route('tour.index', $tour->id)
                         ->with('success', 'Tour berhasil diperbarui.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}






   public function destroy(Tour $tour)
{
    if ($tour->images) {

        $images = is_array($tour->images)
            ? $tour->images
            : json_decode($tour->images, true);

        if (is_array($images)) {
            foreach ($images as $img) {
                $path = public_path('uploads/tours/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }
    }

    $tour->delete();

    return redirect()->route('tour.index')
        ->with('success', 'Tour berhasil dihapus');
}

}
