<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Review::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'data' => Review::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]),
            'status' => 'data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => Review::findOrFait($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review = Review::findOrFail($id);
        return response()->json([
            'data' => $review->create([
                'rating' => $request->rating ?? $review->rating,
                'comment' => $request->comment ?? $review->comment,
            ]),
            'status' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            Review::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
