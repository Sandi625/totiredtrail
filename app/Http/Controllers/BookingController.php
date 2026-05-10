<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
 public function create(Tour $tour)
{
    // Pastikan view yang dipanggil sesuai path
    return view('user.booking.create', compact('tour'));
}


    public function store(Request $request, Tour $tour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'participants' => 'required|integer|min:1',
            'travel_date' => 'required|date',
            'message' => 'nullable|string',
        ]);

        Booking::create([
            'tour_id' => $tour->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'participants' => $request->participants,
            'travel_date' => $request->travel_date,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dikirim!');
    }
}
